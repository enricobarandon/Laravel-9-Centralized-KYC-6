$('document').ready(function() {

    $("#qrcode").on("input",function(e){

        var count = $("#qrcode").val().length;

        delay(function(){
            
            if(count >= 10){
                getUserInfo()
            }
        }, 1000 );

    });
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
        console.log(permanent_address);
        $('#append').append("<p> Full Name: "+ player.first_name + " " + player.middle_name + " " + player.last_name +"</p>")
                    .append("<p> Username: "+ player.username +"</p>")
                    .append("<p> Contact: "+ player.contact +"</p>")
                    .append("<p> Is Active: "+ (player.is_active ? "Active" : "Deactivated") +"</p>")
                    .append("<p> Account Status: "+ (player.status ? player.status.toUpperCase() : "") +"</p>")
                    .append("<p> Country: "+ playerDetails.country +"</p>")
                    .append("<p> Nationality: "+ playerDetails.nationality +"</p>")
                    .append("<p> Date of Birth: "+ playerDetails.date_of_birth +"</p>")
                    .append("<p> Place of Birth: "+ playerDetails.place_of_birth +"</p>")
                    .append("<p> House Number: "+ present_address.house_number +"</p>")
                    .append("<p> Street: "+ present_address.street +"</p>")
                    ;
    } else {

    }
}



// function onQRCodeScanned(scannedText)
// {
//     var scannedTextMemo = document.getElementById("scannedTextMemo");
//     if(scannedTextMemo)
//     {
//         scannedTextMemo.value = scannedText;
//     }
// }


// function provideVideo()
// {
//     var n = navigator;

//     if (n.mediaDevices && n.mediaDevices.getUserMedia)
//     {
//         return n.mediaDevices.getUserMedia({
//         video: {
//             facingMode: "environment"
//         },
//         audio: false
//         });
//     } 
    
//     return Promise.reject('Your browser does not support getUserMedia');
// }

// //funtion returning a promise with a video stream
// function provideVideoQQ()
// {
//     return navigator.mediaDevices.enumerateDevices()
//     .then(function(devices) {
//         var exCameras = [];
//         devices.forEach(function(device) {
//         if (device.kind === 'videoinput') {
//             exCameras.push(device.deviceId)
//         }
//         });
        
//         return Promise.resolve(exCameras);
//     }).then(function(ids){
//         if(ids.length === 0)
//         {
//             return Promise.reject('Could not find a webcam');
//         }
        
//         return navigator.mediaDevices.getUserMedia({
//             video: {
//                 'optional': [{
//                 'sourceId': ids.length === 1 ? ids[0] : ids[1]//this way QQ browser opens the rear camera
//                 }]
//             }
//         });        
//     });                
// }  

// //this function will be called when JsQRScanner is ready to use
// function JsQRScannerReady()
// {
//     //create a new scanner passing to it a callback function that will be invoked when
//     //the scanner succesfully scan a QR code
//     var jbScanner = new JsQRScanner(onQRCodeScanned, provideVideo);
//     //reduce the size of analyzed images to increase performance on mobile devices
//     jbScanner.setSnapImageMaxSize(200);
//     var scannerParentElement = document.getElementById("scanner");
//     if(scannerParentElement)
//     {
//         //append the jbScanner to an existing DOM element
//         jbScanner.appendTo(scannerParentElement);
//     }        
// }
