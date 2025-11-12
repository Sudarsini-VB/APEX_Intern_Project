// Confirmation for delete links
document.addEventListener("DOMContentLoaded", function() {
    const deleteLinks = document.querySelectorAll("a[onclick*='confirm']");
    deleteLinks.forEach(link => {
        link.addEventListener("click", function(e) {
            if(!confirm("Are you sure you want to delete this user?")){
                e.preventDefault();
            }
        });
    });
});
