//color picker helper functionality
App.ColorPicker = (function(Pixel){
    //takes hex in form #ffffff and returns pixel
    function pixelFromColorPicker(hex){
        let r = parseInt(hex.substring(1, 3), 16);
        let g = parseInt(hex.substring(3, 5), 16);
        let b = parseInt(hex.substring(5, 7), 16);
        return Pixel.create(r, g, b);
    }
    
    
    //takes array of hex colors in form #ffffff
    //and returns single Float32Array or rgb values (no alpha)
    function colorsToVecArray(hexColors, maxColors){
        let vec = new Float32Array(maxColors * 3);
        let offset = 0;
        
        hexColors.forEach((hex)=>{
            let r = parseInt(hex.substring(1, 3), 16);
            let g = parseInt(hex.substring(3, 5), 16);
            let b = parseInt(hex.substring(5, 7), 16);
            
            vec[offset]   = r / 255.0;
            vec[offset+1] = g / 255.0;
            vec[offset+2] = b / 255.0;
            
            offset += 3;
        });
        
        
        return vec;
    }
    
    function createPalettes(){
        return [
            {title: 'Custom', isCustom: true},
            {title: 'Cosmic', colors: ['#022e75', '#D2ebf0', '#763a70', '#facbf5', '#0000ff', '#ff00ff', '#ffff00', '#ff8800']},
            {title: 'Ketchup', colors: ['#064000', '#fed9ff', '#cf0e0e', '#e1fade', '#82119d', '#ff00ff', '#ffff71', '#ff8800']},
            {title: 'Rust', colors: ['#060338', '#fadafe', '#bd6a2d', '#e4fafc', '#e2a867', '#203e8a', '#cd3232', '#3f7c62']},
            {title: 'Slime', colors: ['#28012e', '#fcfde1', '#eedb51', '#8ab32d', '#852d97', '#271784', '#a93e2e', '#613f4e']},
            {title: 'Primaries', colors: ['#000000', '#ffffff', '#ff0000', '#00ff00', '#0000ff', '#ff00ff', '#ffff00', '#ff8800']},
        ];
    }
    
    //based on: https://stackoverflow.com/questions/7837456/how-to-compare-arrays-in-javascript?page=1&tab=votes#tab-top
    //note will not work on nested arrays/objects or NaN
    function areColorArraysIdentical(array1, array2){
        return array1.length == array2.length && array1.every((v,i)=> v === array2[i]);
    }
    
    return {
        pixelFromHex: pixelFromColorPicker,
        COLOR_REPLACE_DEFAULT_BLACK_VALUE: '#000000',
        COLOR_REPLACE_DEFAULT_WHITE_VALUE: '#ffffff',
        colorsToVecArray: colorsToVecArray,
        palettes: createPalettes(),
        areColorArraysIdentical: areColorArraysIdentical,
    };
    
})(App.Pixel);