function get_username() {
    const nvs = document.cookie.split(';');

    for (const nv of nvs) {
        if (nv.startsWith("username=")) {
            return nv.substring("username=".length); 
        }
    }
    return "";
}