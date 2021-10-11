let bonus_counter = 1;

function bonus(){
    let _bonus = document.getElementById("bonus_img_container");
    let img = `<img src='https://picsum.photos/200?random=${bonus_counter}'>`
    bonus_counter++;
    _bonus.innerHTML = img;
}

async function section1() {
    let _section1 = document.getElementById("1_result_container");
    let res = "";
    _section1.innerHTML = res;
    let data = await (await fetch('/L2S1_PW1/L2S1_PW1.php?obj=31')).json();
    data.forEach(line => res += `<p>${line}</p>`);
    _section1.innerHTML = res;
}

async function section2(){
    let _section2 = document.getElementById("2_result_container");
    let data = await (await fetch('/L2S1_PW1/L2S1_PW1.php?obj=32')).json();
    let res = `<p>For ${data[0]} change is: `
    data[1].forEach(note => res += `${note[0]}₼:${note[1]}, `);
    res = res.slice(0,-2) + ".</p>";
    _section2.innerHTML = res;
}


async function section3(){
    let _section3 = document.getElementById("3_result_container");
    let data = await (await fetch('/L2S1_PW1/L2S1_PW1.php?obj=33')).json();
    let res = `<p>${data[0]} card number is valid.</p>`
    _section3.innerHTML = res;
}

async function section4(){
    let _section4 = document.getElementById("4_result_container");
    let res_top =
        `<table>
            <tr>
                <th>Deg</th>
                <th>Rad</th>
                <th>Sin</th>
                <th>Cos</th>
                <th>Tan</th>
                <th>Cotan</th>
            </tr>`;
    let res_bottom = `</table>`;
    let res_middle = "";
    _section4.innerHTML = res_top + res_middle + res_bottom;
    let promise = await fetch(`/L2S1_PW1/L2S1_PW1.php?obj=4`);
    let data = await promise.json();
    for (let ii = 0; ii < 360; ii++) {
        let res_row =
           `<tr>
                <th>${ii}</th>
                <th>${data[ii][0]}</th>
                <th>${data[ii][1]}</th>
                <th>${data[ii][2]}</th>
                <th>${data[ii][3]}</th>
                <th>${data[ii][4]}</th>
            </tr>`;
            res_middle += res_row;
    }
    _section4.innerHTML = res_top + res_middle + res_bottom;

}
