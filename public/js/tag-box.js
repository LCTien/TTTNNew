const ul = document.querySelector("#tag-box");
input = ul.querySelector("input");
service = document.getElementById('service');
let tags;
if(service.value == ""){
    tags =[];
}
else
{
    tags = service.value.split(", ");
    createTag();
}

function createTag(){
    ul.querySelectorAll("li").forEach(li => li.remove());
    tags.slice().reverse().forEach(tag => {
        let liTag = ` <li> ${tag} <i class="material-icons" onclick="remove(this,'${tag}')">close</i></li>`;
        ul.insertAdjacentHTML("afterbegin",liTag);
    });
    $("#listService").removeClass("block");
}
function remove(element, tag)
{  
    let index = tags.indexOf(tag);
    tags = [...tags.slice(0,index),...tags.slice(index + 1)];
    element.parentElement.remove();
    if(index == 0)
    {
        if(service.value.split(",").length == 1)
            service.value = service.value.replace(`${tag}`,'');
        else
            service.value = service.value.replace(`${tag}, `,'');
    }
    else
    service.value = service.value.replace(`, ${tag}`,'');

}
$("*").click(function(){
    $("#listService").removeClass("block");
});
function addTag(e)
{
    $("#listService").addClass("block");
    $.ajax({
        type: "get",
        url: "/listService",
        data:{
            service: e.target.value,
        },
        dataType: "json",
        success: function(response){
           $("#listService").html(response);
        }
    })
}
function addTag2(key)
{
    if(!tags.includes(key)){
            tags.push(key);
            createTag();
            if(service.value == "")
                service.value += `${key}`;
            else
                service.value += `, ${key}`;
            input.value ="";
    }
}
input.addEventListener("keyup",addTag);
input.addEventListener("click",function () { 
    $.ajax({
        type: "get",
        url: "/listService",
        data:{
            service: '',
        },
        dataType: "json",
        success: function(response){
           $("#listService").html(response);
           $("#listService").addClass("block");
        }
    })
 });
