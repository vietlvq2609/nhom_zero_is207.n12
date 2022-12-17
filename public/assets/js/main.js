var add = document.getElementById('inserting')
var del = document.getElementById('deleting')
var edit = document.getElementById('updating')
function showForm(action)
{
    if (action == "insert")
    {
        add.setAttribute('class','show')
        del.setAttribute('class','hidden')
        edit.setAttribute('class','hidden')
    }
    else if (action == "delete")
    {
        add.setAttribute('class','hidden')
        del.setAttribute('class','show')
        edit.setAttribute('class','hidden')
    }
    else{
        add.setAttribute('class','hidden')
        del.setAttribute('class','hidden')
        edit.setAttribute('class','show')
    }
}