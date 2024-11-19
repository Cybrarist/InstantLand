(function(w){
    try{


        if(w.editorConfig){
            let selectorManager = (editorConfig.selectorManager = editorConfig.selectorManager || {});

            selectorManager.escapeName = (name) => `${name}`.trim().replace(/([^a-z0-9\w-:/]+)/gi, "-")
        }
    }catch(e){}
})(window)
//
// (function(w){
//     try{
//
//         var currentPath = window.location.pathname;
//
//         // if(w.editorConfig  && currentPath.includes('social-cards')){
//         //     w.editorConfig.dragMode='absolute'
//         // }
//         //
//         // if(w.editorConfig)
//             w.editorConfig.storageManager={
//                 // Enable draggable and dragmove options
//                 // draggableComponents: true,
//                 // draggable: true,
//                 // autosave: false,
//                 allowScripts: 1,
//             }
//
//         // // w.editorConfig.on('load' , function () { console.log("asdsad")})
//     }catch(e){
//         console.error(e)
//     }
// })(window)
//
//
