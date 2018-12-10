const aboID = document.getElementsByClassName("abo_id");

window.addEventListener("load", function()
{
    const aboClass = document.getElementsByClassName("selectAboClass")[0];
    console.log(aboID);
    console.log(aboClass.selectedIndex);

    /*for(let i = 0; i < genreName.length; i++)
    {    
        for(var j = 0; j < genreID.length; j++)
        {
            if(genreID[j].textContent == genreName[i].value)
            {
                genreID[j].innerText = genreName[i].textContent;
            }
        }
    }*/
});