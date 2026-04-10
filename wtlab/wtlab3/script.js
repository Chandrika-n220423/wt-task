const cafename="In Love Cafe";
const coffeeprice=30;
const role="Admin";
let cafestatus="Open";
let ordercount=0;
console.log("Cafe Name:",cafename);
console.log("Coffee Price:", coffeeprice);
console.log("Role:",role);
console.log("Status:",cafestatus);
console.log("Order Count:",ordercount);
document.getElementById("cafenameText").innerText="Cafe Name: "+ cafe.name;
document.getElementById("coffeeprice").innerText="Coffee Price: $"+ coffeeprice;
document.getElementById("cafestatus").innerText="Status: "+ cafestatus;
document.getElementById("ordercount").innerText="Orders Today: "+ ordercount;
function increase(){
    ordercount= ordercount+1;
    document.getElementById("ordercount").innerText="Orders Today: "+ ordercount;
}
function showWelcome(){
    document.getElementById("message").innerText="Welcome to In Love Cafe!";
}
const changestatus = function(){
    document.getElementById("message").innerText="Cafe is Open!";
};
const showThanks=()=>{
    document.getElementById("message").innerText="Thank you for visiting our cafe!";
};
function getTotalPrice(price,quantity){
    return price * quantity;
}
function calculateprice(){
    let total = getTotalPrice(30,3);
    document.getElementById("totalprice").innerText="Total  Bill Amount: $"+total;
}
let secondbill = getTotalPrice(10,2);
console.log("Second Bill Amount:", secondbill);
showThanks();
let cafe={
    name:cafename,
    location: "Vijayawada",
    status:"open",
    rating:5
};
document.getElementById("objname").innerText="Cafe Name:"+ cafe.name;
document.getElementById("objlocation").innerText="Location:"+ cafe["location"];
document.getElementById("objstatus").innerText="Status:"+ cafe.status;
function updateStatus(){
    if (cafe.status==="open"){
        cafe.status="closed";
    } 
    else{
        cafe.status="open";
    }
    document.getElementById(objstatus).innerText="Status:"+cafe.status;
}
document.getElementById("popupBtn").addEventListener("click",function(){
    alert("Welcome to In Love Cafe!");
    let visit = confirm("Do you want to continue?");
    if (!visit){
        document.getElementById(popupresult).innerText="User chose not to contine";
        return;
    }
    let name=prompt("Enter your name:");
    if(name===null||name===""){
        name="Guest";
    }
    document.getElementById("popupresult").innerText="Hello"+name+"!Enjoy your time at our cafee";
});