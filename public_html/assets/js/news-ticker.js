/**
 * Creed Tech - Global News Bar / Top News Ticker
 * Handles rotating news headlines with smooth CSS transitions
 */
(function() {
  'use strict';

  var newsLines = [
    {
      text: "Building reliable digital solutions for modern business needs.",
      linkText: "Explore Services",
      linkUrl: "services"
    },
    {
      text: "Custom software development, cloud infrastructure, and AI automation.",
      linkText: "Explore Services",
      linkUrl: "services"
    },
    {
      text: "Designing practical and intuitive user experiences for web and mobile.",
      linkText: "Explore Services",
      linkUrl: "services"
    },
    {
      text: "Scalable database architecture and technical digital growth solutions.",
      linkText: "Explore Services",
      linkUrl: "services"
    }
  ];

  var tickerTimer = null;
  var currentIndex = 0;

  function initNewsTicker() {
    var newsBox = document.getElementById("animatedNewsBox");
    var newsText = document.getElementById("animatedNewsText");
    var newsLink = document.getElementById("animatedNewsLink");

    // Guard: Check elements exist
    if (!newsBox || !newsText || !newsLink) return;

    // Guard: Prevent duplicate initialization
    if (newsBox.dataset.tickerInitialized === "true") return;
    newsBox.dataset.tickerInitialized = "true";

    // Clear any existing interval
    if (tickerTimer) {
      clearInterval(tickerTimer);
      tickerTimer = null;
    }

    var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function slideNextNews() {
      if (!newsBox || !newsText || !newsLink) return;

      currentIndex = (currentIndex + 1) % newsLines.length;
      var item = newsLines[currentIndex];

      if (prefersReducedMotion) {
        newsText.textContent = item.text;
        newsLink.href = item.linkUrl;
        newsLink.innerHTML = '<span>' + item.linkText + '</span> <span class="text-[#FF6B00]">&rarr;</span>';
        return;
      }

      // 1. Fast Slide Out to Left
      newsBox.className = "news-text-out flex items-center gap-2 truncate w-full text-left";

      setTimeout(function() {
        // 2. Next item data
        newsText.textContent = item.text;
        newsLink.href = item.linkUrl;
        newsLink.innerHTML = '<span>' + item.linkText + '</span> <span class="text-[#FF6B00]">&rarr;</span>';

        // 3. Teleport to Right (no transition)
        newsBox.className = "news-text-in-prep flex items-center gap-2 truncate w-full text-left";

        // 4. Smooth Double rAF Animation Step
        requestAnimationFrame(function() {
          requestAnimationFrame(function() {
            newsBox.className = "news-text-active flex items-center gap-2 truncate w-full text-left";
          });
        });
      }, 350);
    }

    // Start interval
    tickerTimer = setInterval(slideNextNews, 4400);

    // Pause on hover, resume on mouse leave
    newsBox.addEventListener('mouseenter', function() {
      if (tickerTimer) {
        clearInterval(tickerTimer);
        tickerTimer = null;
      }
    });

    newsBox.addEventListener('mouseleave', function() {
      if (!tickerTimer) {
        tickerTimer = setInterval(slideNextNews, 4400);
      }
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initNewsTicker);
  } else {
    initNewsTicker();
  }
})();
