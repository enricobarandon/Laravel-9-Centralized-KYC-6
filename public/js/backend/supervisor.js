$('document').ready(function() {

    $("#qrcode").on("input",function(e){

        var count = $("#qrcode").val().length;

        delay(function(){
            
            if(count >= 10){
                getUserInfo()
            }
        }, 1000 );

    });
    
    // $('#playerInfo').hide();

    $('#btnApprove').on('click', () => {
        if($("#qrcode").val() == ''){
            swal({
                title: "Empty",
                text: "Please scan qr code first!",
                icon: "error",
                timer: 2000,
                button: 'Close'
            });
        }else{
            approve();
        }
        
    })

});

var delay = (function () {

    var timer = 0;

    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };

})();

const getUserInfo = async () => {
    let qrcode = $("#qrcode").val();
    let response = await axios.get('/api/v1/users', { params: { qrcode: qrcode }});
    console.log(response);
    if (response.data != "") {
        let player = response.data;
        let playerDetails = player.user_details;
        let present_address = JSON.parse(playerDetails.present_address);
        let permanent_address = JSON.parse(playerDetails.permanent_address);
        let income = JSON.parse(playerDetails.source_of_income);

        if(player.is_active == 1){
            $('#playerInfo').show();
            $('#pFullName').text(player.first_name + " " + player.middle_name + " " + player.last_name);
            $('#pUsername').text("Username: " + player.username);
            $('#pContact').text("Contact: " + player.contact);
            $('#pAddress').text("Address: " + present_address.house_number + " " + present_address.street + " " + present_address.barangay + ", " + present_address.city + ", " + present_address.province);
            $('#pDateBirth').text(my_date_format(playerDetails.date_of_birth));
            $('#pPlaceBirth').text(playerDetails.place_of_birth);
            $('#pIncome').text(income.select_source_of_income + ": " + income.source_of_income);
            $('#pOccupation').text(playerDetails.occupation);
            $("#userId").val(player.id);
            $("#profilePic").attr("src", '/img/id_picture_selfie/'+ playerDetails.selfie_with_id);
    
            $('#scanner').hide();
        }else{
            swal({
                title: "Account Deactivated",
                text: "Player Account is deactivated please contact administrator",
                icon: "error",
                timer: 2000,
                button: 'Close'
            });
            $('#qrcode').val('').focus();
        }
        
    } else {
        swal({
            title: "No Data Found",
            text: "Account not Exist",
            icon: "error",
            timer: 2000,
            button: 'Close'
        });
        $('#qrcode').val('').focus();
    }
}

function my_date_format(input){
    var d = new Date(Date.parse(input.replace(/-/g, "/")));
    var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var date = month[d.getMonth()] + ". " + d.getDate()   + ", " + d.getFullYear();
    return (date);  
};

function onQRCodeScanned(scannedText)
{
    var scannedTextMemo = document.getElementById("qrcode");
    if(scannedTextMemo)
    {
        scannedTextMemo.value = scannedText;
        
        var count = $("#qrcode").val().length;

        delay(function(){
            
            if(count >= 10){
                getUserInfo()
            }
        }, 1000 );
    }
}


function provideVideo()
{
    var n = navigator;

    if (n.mediaDevices && n.mediaDevices.getUserMedia)
    {
        return n.mediaDevices.getUserMedia({
        video: {
            facingMode: "environment"
        },
        audio: false
        });
    } 
    
    return Promise.reject('Your browser does not support getUserMedia');
}

//funtion returning a promise with a video stream
function provideVideoQQ()
{
    return navigator.mediaDevices.enumerateDevices()
    .then(function(devices) {
        var exCameras = [];
        devices.forEach(function(device) {
        if (device.kind === 'videoinput') {
            exCameras.push(device.deviceId)
        }
        });
        
        return Promise.resolve(exCameras);
    }).then(function(ids){
        if(ids.length === 0)
        {
            return Promise.reject('Could not find a webcam');
        }
        
        return navigator.mediaDevices.getUserMedia({
            video: {
                'optional': [{
                'sourceId': ids.length === 1 ? ids[0] : ids[1]//this way QQ browser opens the rear camera
                }]
            }
        });        
    });                
}  

//this function will be called when JsQRScanner is ready to use
function JsQRScannerReady()
{
    //create a new scanner passing to it a callback function that will be invoked when
    //the scanner succesfully scan a QR code
    var jbScanner = new JsQRScanner(onQRCodeScanned, provideVideo);
    //reduce the size of analyzed images to increase performance on mobile devices
    jbScanner.setSnapImageMaxSize(200);
    var scannerParentElement = document.getElementById("scanner");
    if(scannerParentElement)
    {
        //append the jbScanner to an existing DOM element
        jbScanner.appendTo(scannerParentElement);
    }        
}

const approve = async () => {
    let userId = $('#userId').val();
    let uuid = $('#qrcode').val();
    let response = await axios.post('/api/v1/users/approve', { params: { userId, uuid }});
    if (response.data) {
        swal({
            title: "Approve Player",
            text: "Success Approved Player",
            icon: "success",
            timer: 2000,
            button: 'Close'
        });
        $('#qrcode').val('');
        $('#playerInfo').hide();
        $('#scanner').show();
    } else {
        alert('something went wrong');
    }
}