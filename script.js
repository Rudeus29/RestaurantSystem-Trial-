document.addEventListener("DOMContentLoaded", function () {

    function update(btn, delta) {
      const id = btn.getAttribute("data-id");
      const name = btn.getAttribute("data-name");
      const section = btn.closest("section");
      const qtyEl = section.querySelector(".qty");
  
      fetch("./update.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + encodeURIComponent(id) + "&name=" + encodeURIComponent(name) + "&delta=" + encodeURIComponent(delta)
      })
      .then(r => r.json())
      .then(data => {
        if (!data.ok) return;
        qtyEl.textContent = String(data.amount);
      })
      .catch(err => console.log("connection error:", err));
    }
  
    document.querySelectorAll(".plus").forEach(function(btn){
      btn.addEventListener("click", function(e){
        e.stopPropagation();
        update(this, 1);
      });
    });
  
    document.querySelectorAll(".minus").forEach(function(btn){
      btn.addEventListener("click", function(e){
        e.stopPropagation();
        update(this, -1);
      });
    });
  
  });
  