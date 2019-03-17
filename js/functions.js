function equalsFind(firstPass, secondPass) {
    if (firstPass.value == secondPass.value) {
        $(secondPass).removeClass('addBorderError');
        return true;
    } else {
        $(secondPass).addClass('addBorderError');
        return false;
    }
}

function regexFile(regText, file, i, textErr) {
    $(file).next().hide();
    if (file.value !== "") {
        let fileStr = file.files[i].name;

        if (regText.test(fileStr)) {
            $(file).next().hide();
            return true;
        } else {
            $(file).next().show();
            $(file).next().text(textErr);
            return false;
        }
    } else {
        $(file).next().show();
        $(file).next().text("Unesite fajl");
        return false;
    }
}

function regexFind(regText, field, textErr) {
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

function findExtensions(regText, field, i) {
    $(field).next().hide();
    if (!regText.test(field.files[i].name)) {
        $(field).next().show();
        $(field).next().text("Neki fajl nije u dobrom formatu");
        return true;
    } else {
        $(field).next().hide();
        return false;
    }

}

function emptyFiles(field, textErr) {

    $(field).next().hide();
    if (field.files.length !== 0) {

        return true;
    } else {
        $(field).next().show();
        $(field).next().text(textErr);
        return false;
    }
}


function paginationChange(nowPage, numPages, pageElements) {
    if (numPages <= 1) {
        $("#right").hide();
        $("#left").hide();
    } else {
        if (nowPage === 1) {
            $("#left").hide();
            $("#right").show();
        } else if (nowPage >= numPages) {
            $("#right").hide();
            $("#left").show();
        } else if (pageElements >= numPages) {
            $("#right").hide();
            $("#left").hide();
        } else {
            $("#right").show();
            $("#left").show();
        }
    }

    showPaginationPages(nowPage, numPages, pageElements);
}

function showPaginationPages(nowPage, numPages, pageElements) {
    let list = "";
    let items = document.getElementById("pagination-items");
    let start = pageElements * (nowPage - 1);

    for (let i = 0; i < 3; i++) {
        if (nowPage !== 1) {
            list = `<li  data-item="${nowPage - 1}"><a class="pag-item"  data-now="${nowPage - 1}"  href='#'>${nowPage - 1}</a></li>
            <li data-start="${pageElements * (nowPage - 1)}" data-end="${pageElements * (nowPage)}""><a  data-now="${nowPage}" class="pag-item active-paggination" href='#'>${nowPage}</a></li>
            <li><a class="pag-item" data-now="${nowPage + 1}" href='#'>${nowPage + 1}</a></li>`;
        }
        if (nowPage === 1) {
            list = `  <li data-start="${start}" data-end="${pageElements * (nowPage)}"><a data-now="${nowPage}"class="pag-item active-paggination" href='#'>${nowPage}</a></li>
            <li ><a class="pag-item"  data-now="${nowPage + 1}" href='#'>${nowPage + 1}</a></li>`;
        }
        if (nowPage >= numPages) {
            list = `  <li><a class="pag-item"  data-now="${nowPage - 1}" href='#'>${nowPage - 1}</a></li>
            <li data-start="${start}" data-end="${pageElements * (nowPage)}"><a data-now="${nowPage}" class="pag-item active-paggination"  href='#'>${nowPage}</a></li>`;
        }
        if (numPages <= 1) {
            list = ``;
        }

    }
    items.innerHTML = list;

}

function pagination(numPages, pageElements) {
    let nowPage = 1;

    paginationChange(nowPage, numPages, pageElements)
    $("#right").click(function () {
        nowPage++;
        paginationChange(nowPage, numPages, pageElements)
        cellClick()
    });
    cellClick()
    $("#left").click(function () {
        nowPage--;
        paginationChange(nowPage, numPages, pageElements)
        cellClick()
    })

    function cellClick() {
        $(".pag-item").click(function () {
            nowPage = $(this).data("now");
            paginationChange(nowPage, numPages, pageElements)
            cellClick()
        });
    }
}
