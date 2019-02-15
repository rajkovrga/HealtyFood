function equalsFind(firstPass,secondPass)
{
    if(firstPass.value == secondPass.value)
    {
        $(secondPass).removeClass('addBorderError');
        return true;
    }
    else
    {
        $(secondPass).addClass('addBorderError');
        return false;
    }
}

function regexFile(regText,file,i,textErr) {
    $(file).next().hide();
    if(file.value !== "") {
        let fileStr = file.files[i].name;

        if (regText.test(fileStr)) {
            $(file).next().hide();
            return true;
        } else {
            $(file).next().show();
            $(file).next().text(textErr);
            return false;
        }
    }
    else
    {
        $(file).next().show();
        $(file).next().text("Unesite fajl");
        return false;
    }
}

function regexFind(regText,field,textErr) {
    $(field).next().hide();
    if (regText.test(field.value)) {
        $(field).next().hide();
        return true;
    }
    else {
        $(field).next().show();
        $(field).next().text(textErr);
        return false;
    }
}

function findExtensions(regText,field) {
    if (regText.test(field)) {

        return true;
    }
        return false;

}