const r=document.getElementById("play"),d=document.getElementById("cashOutBtn"),f=document.getElementById("bet_amount"),I=document.getElementById("bet_crash"),T=document.getElementById("cashout_amount"),A=document.getElementById("previous_bet_point"),N=document.getElementById("previous_bet_amount"),p=document.getElementById("round"),u=document.getElementById("busted"),k=document.querySelector(".take-out-graph");document.getElementById("count-down");const i=document.createElement("div"),m=document.createElement("h2"),c=document.createElement("h2");let h=document.getElementById("point"),_;localStorage.getItem("user_token");const v=document.getElementById("moving-image");function E(){$.get("/api/settings?name=min_game",function(t,a){var e=t[0].value;localStorage.setItem("min_crash",e)})}function C(){$.get("/api/settings?name=max_game",function(t,a){var e=t[0].value;localStorage.setItem("max_crash",e)})}let x=400,S=0;function F(){v.style.left="300px",v.style.top="0px",r.addEventListener("click",async()=>{if(!f.value)alert("Please add amount");else if(!I.value)alert("please add crash point");else{const t=Number(f.value),a=$("#gt").val(),e=Number(a);if(t+50>e)alert("no enough money");else{r.setAttribute("disabled",""),r.innerText="Bet Placed";let n=localStorage.getItem("user_id"),o=localStorage.getItem("username"),s=$("input[name=_token]").val();const l={user_id:n,username:o,bet_amount:f.value,bet_crash:I.value,token:s,busted_value:_};$.ajax({url:"/api/setbet",type:"POST",headers:{Authorization:"Bearer "+localStorage.getItem("user_token")},data:l,success:function(g){if(g.status==!0){var y=g.lastID;localStorage.setItem("user_bet_id4next_round",y),localStorage.setItem("user_bet_value",I.value),w(),B(),z(),r.innerText="Wait for next round",r.setAttribute("disabled","")}}})}}})}function H(){let t=6;const a=setInterval(()=>{t--,m.innerText="Next Round In",c.innerText=`${t}`,m.classList.add("busted-text"),c.classList.add("busted-text","busted-text-other"),u.append(i),u.classList.add("busted-wrap"),i.append(m),i.append(c),t===0&&(clearInterval(a),u.innerText="",u.classList.remove("busted-wrap"),c.classList.remove("busted-text-other"),k.style.display="block",E(),Number(localStorage.getItem("min_crash")),L())},1e3)}function L(t){E(),C();const a=Number(localStorage.getItem("min_crash")),e=Number(localStorage.getItem("max_crash")),n=a,o=e;var s=a;r.removeAttribute("disabled");let l=localStorage.getItem("user_bet_id4next_round");l==null?(r.innerText="Play",p.value=0):(localStorage.setItem("user_bet_id",l),r.style.display="none",d.style.display="block",p.value=1,localStorage.removeItem("user_bet_id4next_round")),_=j(n,o);const g=_;localStorage.setItem("busted_value",g),$.post("api/save_busted_value",{busted_value:_,user_id:localStorage.getItem("user_id")});const y=setInterval(()=>{h.innerText=`${s.toFixed(2)}x`,s+=.01;let b=Number(s.toFixed(2));S+=1.5,x-=1,v.style.left=`${S}px`,v.style.top=`${x}px`,T.innerHTML=b;var O=A.innerHTML;T.innerHTML=(b*N.innerHTML).toFixed(2),localStorage.getItem("busted_value"),p.value==1&&b==O&&(P(),d.style.display="none",localStorage.removeItem("user_bet_value"),localStorage.removeItem("busted_value")),b>=_&&(M(),clearInterval(y),h.innerHTML="",k.style.display="none",u.append(i),m.innerText="Busted",w(),B(),c.innerText=`@ ${s.toFixed(2)}x`,m.classList.add("busted-text"),c.classList.add("busted-text"),u.append(i),u.classList.add("busted-wrap"),i.append(m),i.append(c),setTimeout(H,3e3))},100);x=400,S=0}document.addEventListener("DOMContentLoaded",()=>{L(),F()});function j(t,a){return Number((Math.random()*(a-t+1)+t).toFixed(2))}function M(){var t=localStorage.getItem("user_bet_id");if(t!=null){var a=localStorage.getItem("user_id");$.ajax({url:"/api/check_if_win",type:"POST",headers:{Authorization:"Bearer "+localStorage.getItem("user_token")},data:{user_bet_id:t,user_id:a},success:function(e){e.status==!0?(e.lastID,localStorage.removeItem("user_bet_id"),d.style.display="none",r.style.display="block"):(D(),e.lastID,localStorage.removeItem("user_bet_id"),d.style.display="none",r.style.display="block")}})}}async function w(){let t=localStorage.getItem("user_id");var a="/api/transactions/user_balance/"+t;$.ajaxSetup({headers:{Authorization:"Bearer "+localStorage.getItem("user_token")}}),$.getJSON(a,{}).done(function(e){JSON.stringify(e);var n=e.balance;$("#gt").val(n);function o(s){return s.toString().replace(/(\d)(?=(\d{ 3 })+(?!\d))/g,"$1,")}$("#user_wallet_bal").text(o(n))}).done(function(){}).fail(function(e,n,o){$("#user_wallet_bal").text("0.00"),$("#gt").val(0)}).always(function(){})}async function B(){let t=localStorage.getItem("user_id");var a="/api/transactions/user_bonus/"+t;$.ajaxSetup({headers:{Authorization:"Bearer "+localStorage.getItem("user_token")}}),$.getJSON(a,{}).done(function(e){JSON.stringify(e);var n=e.balance;$("#gt2").val(n);function o(s){return s.toString().replace(/(\d)(?=(\d{ 3 })+(?!\d))/g,"$1,")}$("#user_wallet_bonus").text(o(n))}).done(function(){}).fail(function(e,n,o){$("#user_wallet_bonus").text("0.00"),$("#gt2").val(0)}).always(function(){})}async function P(){window.Swal.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:5e3,padding:"2em",customClass:"sweet-alerts"}).fire({icon:"success",title:"Hurray!!! you won",padding:"2em",customClass:"sweet-alerts"})}async function D(){window.Swal.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:5e3,padding:"2em",customClass:"sweet-alerts"}).fire({icon:"success",title:"You lose bet, try again",padding:"2em",customClass:"sweet-alerts"})}async function z(){let t=localStorage.getItem("user_id");var a="/api/previous_game/"+t;$.ajaxSetup({headers:{Authorization:"Bearer "+localStorage.getItem("user_token")}}),$.getJSON(a,{}).done(function(e){JSON.stringify(e);var n=e.bet_crash,o=e.bet_amount;$("#previous_bet_point").text(n),$("#previous_bet_amount").text(o)}).done(function(){}).fail(function(e,n,o){}).always(function(){})}d.addEventListener("click",function(t){let a=h.innerText;a=a.replace(/x/g,""),a=Number.parseFloat(a);var n=(a*Number.parseFloat(N.innerHTML).toFixed(2)).toFixed(2),o=localStorage.getItem("user_bet_id");if(o!=null){var s=localStorage.getItem("user_id");$.ajax({url:"/api/cashout_win",type:"POST",headers:{Authorization:"Bearer "+localStorage.getItem("user_token")},data:{user_bet_id:o,user_id:s,user_bet_amount:n},success:function(l){l.status==!0?(w(),B(),l.lastID,localStorage.removeItem("user_bet_id"),d.style.display="none",r.style.display="none"):(D(),l.lastID,p.value==0,localStorage.removeItem("user_bet_id"),d.style.display="none",r.style.display="block")}})}});