function r(e,t="success"){const o=`toast-${Date.now()}`,c=t==="success"?"#d4edda":"#f8d7da",n=t==="success"?"#155724":"#721c24",a=t==="success"?"#c3e6cb":"#f5c6cb",s=document.createElement("div");s.id=o,s.className="toast-container toast-enter",s.setAttribute("role","alert"),s.style.backgroundColor=c,s.style.color=n,s.style.border=`1px solid ${a}`,s.innerHTML=`
        <div class="toast-content">
            <strong>${t==="success"?"✔":"⚠"}</strong>
            <span style="margin-left: 10px;">${e}</span>
        </div>
    `,document.body.appendChild(s),setTimeout(()=>{s.classList.remove("toast-enter"),s.classList.add("toast-exit"),s.addEventListener("animationend",()=>s.remove())},2500)}export{r as s};
