//module for saving and retrieving user settings in localStorage
App.UserSettings = (function(){
    const USER_SAVED_PALETTES_KEY = 'user-saved-palettes';
    const USER_GLOBAL_SETTINGS_KEY = 'user-global-settings';

    function savePalettes(palettes){
        localStorage.setItem(USER_SAVED_PALETTES_KEY, JSON.stringify(palettes));
    }

    function getSettingOrDefault(key, defaultValue){
        const setting = localStorage.getItem(key);
        if(!setting){
            return defaultValue;
        }
        return JSON.parse(setting);
    }

    function saveGlobalSettings(globalSettings){
        localStorage.setItem(USER_GLOBAL_SETTINGS_KEY, JSON.stringify(globalSettings));
    }

    function defaultGlobalSettings(){
        return {
            isWebglEnabled: true,
            isLivePreviewEnabled: true,
            automaticallyResizeLargeImages: true,
            showOriginalImage: false,
        };
    }


    return {
        getPalettes: ()=>{ return getSettingOrDefault(USER_SAVED_PALETTES_KEY, []); },
        savePalettes,
        getGlobalSettings: ()=>{ return getSettingOrDefault(USER_GLOBAL_SETTINGS_KEY, defaultGlobalSettings()); },
        saveGlobalSettings,
    };
})();