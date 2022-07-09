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

var getUserInfo = () => {
    let qrcode = $("#qrcode").val();
    let response = axios.get('/api/v1/users');
    console.log(response);
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
