// Get all the summary elements
const summaries = document.querySelectorAll("summary.accordion-summary");

// Add click event listeners to each summary element
summaries.forEach((summary) => {
  summary.addEventListener("click", function () {
    let panel = this.nextElementSibling;
    let expanded = this.getAttribute("aria-expanded") === "true";

    // Toggle the aria-hidden attribute
    panel.setAttribute("aria-hidden", expanded);

    // Toggle the panel's height to enable smooth transitions
    // panel.style.maxHeight = expanded ? "0" : panel.scrollHeight + "px";

    // Update the aria-expanded attribute
    this.setAttribute("aria-expanded", !expanded);
  });
});
