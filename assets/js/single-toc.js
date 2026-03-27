/**
 * Table of Contents functionality for single post pages
 * Only loads on single.php pages
 */
document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".toc-link");
    const sections = Array.from(links).map(link => {
        const id = link.getAttribute("href");
        return document.querySelector(id);
    });
    
    // Debug: Log TOC elements found
    console.log('TOC Links found:', links.length);
    console.log('TOC Sections found:', sections.length);

    function onScroll() {
        let currentIndex = 0;
        // Account for sticky header - use responsive offset
        const headerOffset = window.innerWidth >= 1024 ? 120 : 140; // Increased values for better visibility
        
        sections.forEach((section, i) => {
            if (section && section.offsetTop <= window.scrollY + headerOffset) {
                currentIndex = i;
            }
        });

        links.forEach(link => link.classList.remove("font-bold"));
        if (links[currentIndex]) {
            links[currentIndex].classList.add("font-bold");
        }
    }

    // Also handle window resize to recalculate on orientation change
    window.addEventListener('resize', onScroll);

    window.addEventListener("scroll", onScroll);
    onScroll();
});
