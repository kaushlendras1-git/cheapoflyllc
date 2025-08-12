export default function showToast(message, type = "success") {
    const toastId = `toast-${Date.now()}`;

    const styleMap = {
        success: {
            bgColor: "#28a745",     // Bootstrap green
            textColor: "#ffffff",
            icon: "✔",              // Unicode check mark
            borderColor: "#218838"
        },
        error: {
            bgColor: "#dc3545",     // Bootstrap red
            textColor: "#ffffff",
            icon: "⚠",
            borderColor: "#c82333"
        }
    };

    const style = styleMap[type] || styleMap.success;

    const toast = document.createElement("div");
    toast.id = toastId;
    toast.className = "toast-container toast-enter";
    toast.setAttribute("role", "alert");

    toast.style.cssText = `
        background-color: ${style.bgColor};
        color: ${style.textColor};
        border: 1px solid ${style.borderColor};
        padding: 14px 20px;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        font-family: 'Segoe UI', sans-serif;
        font-size: 16px;
        display: flex;
        align-items: center;
        max-width: 340px;
        z-index: 9999;
        position: fixed;
        top: 20px;
        right: 20px;
    `;

    toast.innerHTML = `
        <div style="display: flex; align-items: center;">
            <strong style="font-size: 18px;">${style.icon}</strong>
            <span style="margin-left: 10px;">${message}</span>
        </div>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove("toast-enter");
        toast.classList.add("toast-exit");
        toast.addEventListener("animationend", () => toast.remove());
    }, 4500);
}
