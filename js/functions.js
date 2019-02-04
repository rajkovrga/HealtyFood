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

function regexFind(regText,field,textErr) {
    $(field).next().hide();
    if (regText.test(field.value)) {
        $(field).next().hide();
        return true;
    } else {
        $(field).next().show();
        $(field).next().text(textErr);
        return false;
    }
}