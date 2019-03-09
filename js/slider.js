document.addEventListener("DOMContentLoaded",function()
{
let position = 0;
let mainPhoto = document.querySelector("#slider img");
let smallPhoto = document.querySelectorAll(".small-photos img");
changePhoto(position);

let next = document.getElementById("next");
let prev = document.getElementById("prev");

next.addEventListener("click",function()
{
    position++;
    if(position >= smallPhoto.length)
    {
        position = 0;
    }
    changePhoto(position);
});
prev.addEventListener("click",function()
{
    position--;
    if(position < 0)
    {
        position = smallPhoto.length-1;
    }
    changePhoto(position);
});

function changePhoto(position)
{
    mainPhoto.src = smallPhoto[position].src;
    removeBorder()

}
function removeBorder()
{
    for(let i = 0; i < smallPhoto.length;i++)
    {
        smallPhoto[i].classList.remove("border-img");
    }    
    smallPhoto[position].classList.add("border-img");
}

for(let i = 0; i < smallPhoto.length;i++)
{
    smallPhoto[i].addEventListener("click",function()
    {
        let src = smallPhoto[i].src;
        mainPhoto.src = src;
        position = i;
        removeBorder()
    });
}

});