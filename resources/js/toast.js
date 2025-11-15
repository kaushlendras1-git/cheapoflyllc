export default function showToast(message, type = "success") {
    const toastId = `toast-${Date.now()}`;

    const styleMap = {
        success: {
            bgColor: "#ffffff",
            textColor: "#155724",
            icon: "✓",
            accentColor: "#28a745",
            shadowColor: "rgba(40, 167, 69, 0.3)"
        },
        error: {
            bgColor: "#ffffff",
            textColor: "#721c24",
            icon: "✕",
            accentColor: "#dc3545",
            shadowColor: "rgba(220, 53, 69, 0.3)"
        },
        warning: {
            bgColor: "#ffffff",
            textColor: "#856404",
            icon: "⚠",
            accentColor: "#ffc107",
            shadowColor: "rgba(255, 193, 7, 0.3)"
        },
        info: {
            bgColor: "#ffffff",
            textColor: "#0c5460",
            icon: "ℹ",
            accentColor: "#17a2b8",
            shadowColor: "rgba(23, 162, 184, 0.3)"
        }
    };

    const style = styleMap[type] || styleMap.success;

    const toast = document.createElement("div");
    toast.id = toastId;
    toast.className = "beautiful-toast";

    toast.style.cssText = `
        background: ${style.bgColor};
        color: ${style.textColor};
        border: 1px solid ${style.accentColor}20;
        border-left: 5px solid ${style.accentColor};
        padding: 8px 16px;
        border-radius: 12px;
        box-shadow: 0 10px 40px ${style.shadowColor}, 0 6px 20px rgba(0,0,0,0.1);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 15px;
        font-weight: 500;
        display: flex;
        align-items: center;
        min-width: 350px;
        max-width: 450px;
        z-index: 10000;
        position: fixed;
        top: 30px;
        right: 30px;
        transform: translateX(400px);
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    `;

    toast.innerHTML = `
        <div style="
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: ${style.accentColor}15;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            color: ${style.accentColor};
            margin-right: 16px;
            flex-shrink: 0;
        ">${style.icon}</div>
        <div style="flex: 1; line-height: 1.2; word-wrap: break-word;">${message}</div>
        <div style="
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: ${style.accentColor}10;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 16px;
            cursor: pointer;
            opacity: 0.6;
            transition: all 0.2s ease;
            font-size: 12px;
            color: ${style.accentColor};
        " onmouseover="this.style.opacity='1'; this.style.background='${style.accentColor}20'" 
           onmouseout="this.style.opacity='0.6'; this.style.background='${style.accentColor}10'"
           onclick="this.parentElement.style.transform='translateX(400px)'; this.parentElement.style.opacity='0'; setTimeout(() => this.parentElement.remove(), 400)">×</div>
    `;

    document.body.appendChild(toast);

    // Animate in
    setTimeout(() => {
        toast.style.transform = "translateX(0)";
        toast.style.opacity = "1";
    }, 100);

    // Auto dismiss
    setTimeout(() => {
        toast.style.transform = "translateX(400px)";
        toast.style.opacity = "0";
        setTimeout(() => toast.remove(), 400);
    }, 4000);

    // Add hover effect
    toast.addEventListener('mouseenter', () => {
        toast.style.transform = "translateX(-10px) scale(1.02)";
        toast.style.boxShadow = `0 15px 50px ${style.shadowColor}, 0 8px 25px rgba(0,0,0,0.15)`;
    });

    toast.addEventListener('mouseleave', () => {
        toast.style.transform = "translateX(0) scale(1)";
        toast.style.boxShadow = `0 10px 40px ${style.shadowColor}, 0 6px 20px rgba(0,0,0,0.1)`;
    });
}