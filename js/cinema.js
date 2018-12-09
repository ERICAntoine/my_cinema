/* GET DATE */

const date = document.getElementById('date');
const createInput = document.createElement("input");
const dateClass = document.getElementById('dateClass');
createInput.setAttribute("type","hidden");
dateClass.appendChild(createInput);

date.addEventListener("change", function(e)
{
    const dateValue = date.value;
    createInput.setAttribute("value", dateValue);
    console.log(createInput);
});

/* GET ID_GENRE AND ID_DISTRIB*/

const genreName = document.getElementsByClassName("id_genre");
const distribName = document.getElementsByClassName("id_distrib");


window.addEventListener("load", function()
{
    const genreID = document.getElementsByClassName("genre_id");
    const distribID = document.getElementsByClassName("distrib_id");

    for(let i = 0; i < genreName.length; i++)
    {    
        for(var j = 0; j < genreID.length; j++)
        {
            if(genreID[j].textContent == genreName[i].value)
            {
                genreID[j].innerText = genreName[i].textContent;
            }
        }
    }

    for(let i = 0; i < distribName.length; i++)
    {    
        for(var j = 0; j < distribID.length; j++)
        {
            if(distribID[j].textContent == distribName[i].value)
            {
                distribID[j].innerText = distribName[i].textContent;
            }
        }
    }

});


