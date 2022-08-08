function encRyption(mail)
{
    var mapArray = [];
    var chars="abcdefghijklmnopqrstuvwxyz";

    var output='';

    for (let index = 0; index < chars.length; index++) {
        var x = chars.charAt(index);
        var y = chars.charAt((index+13) % 26);

        mapArray[x] = y;
        mapArray[x.toUpperCase()] = y.toUpperCase();
    }

    for (let index = 0; index < mail.length; index++) {
        var c = mail.charAt(index)
        output += ((c >= 'A' && c <= 'Z') || (c >= 'a' && c <= 'z' ? mapArray[c] : c ))
    }
    return output;
}

function decRyption(mail)
{
    var linkstr = 'mailto:';
    let addressString = encRyption(mail);
    linkstr += addressString;
    //document.location.href = linkstr;
   return linkstr;
}

console.log(decRyption('gallaoui101@gmail.com'));