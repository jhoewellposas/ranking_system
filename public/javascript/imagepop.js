function openPopup(url) {
    var width = 800;
    var height = 600;
    var left = (window.screen.width / 2) - (width / 2);
    var top = (window.screen.height / 2) - (height / 2);
    var windowFeatures = `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=${width}, height=${height}, top=${top}, left=${left}`;
    window.open(url, 'ImagePopup', windowFeatures);
}
