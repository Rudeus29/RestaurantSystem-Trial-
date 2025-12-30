const DEBUG = false;
const log = (...args) => DEBUG && console.log(...args);

document.addEventListener("click", async (e) => {
  const btn = e.target.closest("button.plus, button.minus");
  if (!btn) return;

  const card = btn.closest(".menu-card, section") || btn.parentElement;
  if (!card) {
    log("No container for button", btn);
    return;
  }

  const qtyEl = card.querySelector(".qty");
  if (!qtyEl) {
    log("No .qty in container", card);
    return;
  }

  const id = btn.dataset.id;
  const name = btn.dataset.name ?? "";
  const delta = btn.classList.contains("plus") ? "1" : "-1";

  try {
    const r = await fetch("./update.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({ id, name, delta }).toString(),
    });

    const text = await r.text();
    log("update.php status:", r.status);
    log("update.php raw:", text);

    if (!r.ok) return;

    const data = JSON.parse(text);
    if (!data.ok) return;

    qtyEl.textContent = String(data.amount);
  } catch (err) {
    log("fetch/parse error:", err);
  }
});
