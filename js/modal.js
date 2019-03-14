document.addEventListener("DOMContentLoaded", function () {
    $(".my-modal").css({display: "none"});

    $(".modal-user").click(function () {

        let xr = new XMLHttpRequest();
        xr.open("POST", "addContent/getUser.php");
        xr.addEventListener("load", function () {
            document.getElementsByClassName("text-response")[0].innerHTML = xr.responseText;
            $(".my-modal").css({display: "flex"});
        });
        let obj = {
            id: $(this).data("id")
        }
        xr.send(JSON.stringify(obj));
        console.log($(this).attr("data-id"))

    });
    $("#my-modal-close").click(function () {
        $(".my-modal").css({display: "none"});
    })

});