export default function showToast(message, type = "success") {
    const toastId = `toast-${Date.now()}`;
    const bgColor = type === "success" ? "#d4edda" : "#f8d7da";
    const textColor = type === "success" ? "#155724" : "#721c24";
    const borderColor = type === "success" ? "#c3e6cb" : "#f5c6cb";

    const toast = document.createElement("div");
    toast.id = toastId;
    toast.className = "toast-container toast-enter";
    toast.setAttribute("role", "alert");
    toast.style.backgroundColor = bgColor;
    toast.style.color = textColor;
    toast.style.border = `1px solid ${borderColor}`;

    toast.innerHTML = `
        <div class="toast-content">
            <strong>${type === "success" ? "✔" : "⚠"}</strong>
            <span style="margin-left: 10px;">${message}</span>
        </div>
    `;

    // Append to body or main container
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove("toast-enter");
        toast.classList.add("toast-exit");
        toast.addEventListener("animationend", () => toast.remove());
    }, 2500);
}
