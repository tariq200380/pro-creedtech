/**
 * Creed Tech - Services Interactive Controller
 * Handles service selection, subtabs, rendering, mobile arrows, ARIA sync, and hash routing
 */

var activeSvcId = 'software-development';
var activeSubTab = 'overview';
var isInitialLoad = true;
var switchTimer = null;

function h(str) {
  if (!str) return '';
  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

// ================= MOBILE CAROUSEL CONTROLLERS =================
function updateCarouselArrows() {
  // 1. Service Arrows
  var leftSvcBtn = document.getElementById('svcSelectorLeftBtn');
  var rightSvcBtn = document.getElementById('svcSelectorRightBtn');
  if (leftSvcBtn && rightSvcBtn) {
    var sIdx = ORDERED_SVCS.indexOf(activeSvcId);
    if (sIdx === -1) sIdx = 0;
    
    if (sIdx === 0) {
      leftSvcBtn.style.visibility = 'hidden';
      leftSvcBtn.style.pointerEvents = 'none';
    } else {
      leftSvcBtn.style.visibility = 'visible';
      leftSvcBtn.style.pointerEvents = 'auto';
    }

    if (sIdx === ORDERED_SVCS.length - 1) {
      rightSvcBtn.style.visibility = 'hidden';
      rightSvcBtn.style.pointerEvents = 'none';
    } else {
      rightSvcBtn.style.visibility = 'visible';
      rightSvcBtn.style.pointerEvents = 'auto';
    }
  }

  // 2. Subsection Arrows
  var leftSubBtn = document.getElementById('subtabLeftBtn');
  var rightSubBtn = document.getElementById('subtabRightBtn');
  if (leftSubBtn && rightSubBtn) {
    var tIdx = ORDERED_SUBTABS.indexOf(activeSubTab);
    if (tIdx === -1) tIdx = 0;

    if (tIdx === 0) {
      leftSubBtn.style.visibility = 'hidden';
      leftSubBtn.style.pointerEvents = 'none';
    } else {
      leftSubBtn.style.visibility = 'visible';
      leftSubBtn.style.pointerEvents = 'auto';
    }

    if (tIdx === ORDERED_SUBTABS.length - 1) {
      rightSubBtn.style.visibility = 'hidden';
      rightSubBtn.style.pointerEvents = 'none';
    } else {
      rightSubBtn.style.visibility = 'visible';
      rightSubBtn.style.pointerEvents = 'auto';
    }
  }
}

function navigateServiceCarousel(dir) {
  var curIdx = ORDERED_SVCS.indexOf(activeSvcId);
  if (curIdx === -1) curIdx = 0;
  var nextIdx = dir === 'next' ? curIdx + 1 : curIdx - 1;
  if (nextIdx < 0 || nextIdx >= ORDERED_SVCS.length) return;
  selectSvc(ORDERED_SVCS[nextIdx], true);
}

function navigateSubtabCarousel(dir) {
  var curIdx = ORDERED_SUBTABS.indexOf(activeSubTab);
  if (curIdx === -1) curIdx = 0;
  var nextIdx = dir === 'next' ? curIdx + 1 : curIdx - 1;
  if (nextIdx < 0 || nextIdx >= ORDERED_SUBTABS.length) return;
  setSubTab(ORDERED_SUBTABS[nextIdx]);
}

function selectSvc(id, isUserAction) {
  if (!id || !SVCS[id]) {
    id = 'software-development';
  }
  activeSvcId = id;

  // 1. Immediately update top selector cards
  var allCards = document.querySelectorAll('.svc-select-card');
  for (var i = 0; i < allCards.length; i++) {
    var card = allCards[i];
    var isActive = (card.id === 'svc-card-' + id);
    if (isActive) {
      card.classList.add('active');
      card.setAttribute('aria-selected', 'true');
      card.setAttribute('tabindex', '0');
    } else {
      card.classList.remove('active');
      card.setAttribute('aria-selected', 'false');
      card.setAttribute('tabindex', '-1');
    }
  }

  // 2. Reset subtab to overview when switching services
  activeSubTab = 'overview';
  var tabs = ['overview', 'services', 'benefits', 'process', 'proven'];
  for (var t = 0; t < tabs.length; t++) {
    var tabBtn = document.getElementById('subtab-btn-' + tabs[t]);
    if (tabBtn) {
      if (tabs[t] === 'overview') {
        tabBtn.classList.add('active');
        tabBtn.setAttribute('aria-selected', 'true');
        tabBtn.setAttribute('tabindex', '0');
      } else {
        tabBtn.classList.remove('active');
        tabBtn.setAttribute('aria-selected', 'false');
        tabBtn.setAttribute('tabindex', '-1');
      }
    }
  }

  var panel = document.getElementById('serviceDetailPanel') || document.getElementById('svcContentPane');
  if (panel) {
    panel.setAttribute('aria-labelledby', 'subtab-btn-overview');
  }

  // 3. Update sidebar info & dynamic CTA synchronously
  var svc = SVCS[id];
  var numEl = document.getElementById('sidebarSvcNum');
  if (numEl) numEl.textContent = svc.num;
  var nameEl = document.getElementById('sidebarSvcName');
  if (nameEl) nameEl.textContent = svc.name;
  var techLabel = document.getElementById('techStackServiceName');
  if (techLabel) techLabel.textContent = svc.name;

  var sbTitle = document.getElementById('sidebarCtaTitle');
  if (sbTitle && svc.cta && svc.cta.heading) sbTitle.textContent = svc.cta.heading;
  var sbDesc = document.getElementById('sidebarCtaDesc');
  if (sbDesc && svc.cta && svc.cta.desc) sbDesc.textContent = svc.cta.desc;

  // 4. Update hash in URL via replaceState without triggering page jump
  if (window.location.hash !== '#' + id) {
    try {
      window.history.replaceState(null, '', '#' + id);
    } catch(e) {}
  }

  // 6. Update arrow states
  updateCarouselArrows();

  // 7. Render content with smooth transition or instant on load
  var panel = document.getElementById('serviceDetailPanel') || document.getElementById('svcContentPane');

  if (isInitialLoad || !isUserAction) {
    if (!(isInitialLoad && id === 'software-development')) {
      renderSubTabContent();
      renderTechStack();
    }
    if (panel) panel.classList.remove('is-switching');
  } else {
    if (switchTimer) {
      clearTimeout(switchTimer);
      switchTimer = null;
    }

    if (panel) {
      panel.classList.add('is-switching');
    }

    switchTimer = setTimeout(function() {
      renderSubTabContent();
      renderTechStack();

      requestAnimationFrame(function() {
        requestAnimationFrame(function() {
          var p = document.getElementById('serviceDetailPanel') || document.getElementById('svcContentPane');
          if (p) {
            p.classList.remove('is-switching');
          }
        });
      });
      switchTimer = null;
    }, 120);
  }
}

function setSubTab(tab) {
  activeSubTab = tab;

  // Update active state in sticky sidebar synchronously
  var tabs = ['overview', 'services', 'benefits', 'process', 'proven'];
  for (var i = 0; i < tabs.length; i++) {
    var btn = document.getElementById('subtab-btn-' + tabs[i]);
    if (btn) {
      if (tabs[i] === tab) {
        btn.classList.add('active');
        btn.setAttribute('aria-selected', 'true');
        btn.setAttribute('tabindex', '0');
      } else {
        btn.classList.remove('active');
        btn.setAttribute('aria-selected', 'false');
        btn.setAttribute('tabindex', '-1');
      }
    }
  }

  var panel = document.getElementById('serviceDetailPanel') || document.getElementById('svcContentPane');
  if (panel) {
    panel.setAttribute('aria-labelledby', 'subtab-btn-' + tab);
  }

  updateCarouselArrows();

  var panel = document.getElementById('serviceDetailPanel') || document.getElementById('svcContentPane');
  if (switchTimer) {
    clearTimeout(switchTimer);
    switchTimer = null;
  }

  if (panel) {
    panel.classList.add('is-switching');
  }

  switchTimer = setTimeout(function() {
    renderSubTabContent();
    requestAnimationFrame(function() {
      requestAnimationFrame(function() {
        var p = document.getElementById('serviceDetailPanel') || document.getElementById('svcContentPane');
        if (p) {
          p.classList.remove('is-switching');
        }
      });
    });
    switchTimer = null;
  }, 120);
}

function renderSubTabContent() {
  var svc = SVCS[activeSvcId];
  if (!svc) return;

  var pane = document.getElementById('serviceDetailPanel') || document.getElementById('svcContentPane');
  if (!pane) return;

  var checkIcon = '<span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;border-radius:50%;background:#EFF6FF;border:1px solid #BFDBFE;color:#0052FF;flex-shrink:0;">' +
    '<svg style="width:13px;height:13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>' +
  '</span>';

  var resultIcon = '<span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:8px;background:#DBEAFE;border:1px solid #BFDBFE;color:#0052FF;flex-shrink:0;">' +
    '<svg style="width:16px;height:16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>' +
  '</span>';

  var paneTitle = svc.name;
  var paneSubtitle = svc.tagline || '';
  var paneDesc = svc.intro || '';
  var html = '';

  if (svc.subHeadings) {
    if (activeSubTab === 'services' && svc.subHeadings.services) {
      paneTitle = svc.subHeadings.services;
      paneSubtitle = '';
      paneDesc = svc.subHeadings.servicesDesc || '';
    } else if (activeSubTab === 'benefits' && svc.subHeadings.benefits) {
      paneTitle = svc.subHeadings.benefits;
      paneSubtitle = '';
      paneDesc = svc.subHeadings.benefitsDesc || '';
    } else if (activeSubTab === 'process' && svc.subHeadings.process) {
      paneTitle = svc.subHeadings.process;
      paneSubtitle = '';
      paneDesc = svc.subHeadings.processDesc || '';
    } else if (activeSubTab === 'proven' && svc.subHeadings.results) {
      paneTitle = svc.subHeadings.results;
      paneSubtitle = '';
      paneDesc = svc.subHeadings.resultsDesc || '';
    }
  }

  // Header Badge + Title + Subtitle + Description + Divider
  var headerHtml = '<div style="padding-bottom:24px;margin-bottom:24px;border-bottom:1px solid #E2E8F0;">' +
    '<div style="display:inline-flex;align-items:center;gap:6px;padding:4px 12px;background:#FFF3EB;border:1px solid #FFD8BE;border-radius:6px;color:#FF6B00;font-size:12px;font-weight:700;letter-spacing:0.04em;line-height:1;margin-bottom:12px;">' +
      '<span>SERVICE ' + h(svc.num) + ' / 08</span>' +
    '</div>' +
    '<h3 style="font-size:clamp(30px, 3.2vw, 38px);font-weight:700;color:#0F172A;letter-spacing:-0.025em;margin:0 0 8px;line-height:1.2;">' +
      h(paneTitle) +
    '</h3>' +
    (paneSubtitle ? '<p style="font-size:18px;font-weight:600;color:#0052FF;margin:0 0 12px;line-height:1.45;">' + h(paneSubtitle) + '</p>' : '') +
    '<p style="font-size:17px;color:#475569;line-height:1.65;margin:0;max-width:850px;">' + h(paneDesc) + '</p>' +
  '</div>';

  // 1. OVERVIEW TAB (4 Cards: 2-column grid)
  if (activeSubTab === 'overview') {
    var cardsHtml = (svc.overview || []).map(function(item) {
      return '<div class="svc-feature-card">' +
        '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">' +
          '<span style="font-size:0.6875rem;font-weight:800;color:#0052FF;background:#EFF6FF;border:1px solid #DBEAFE;padding:3px 9px;border-radius:4px;text-transform:uppercase;letter-spacing:0.04em;">' + h(item.badge) + '</span>' +
          '<span style="width:8px;height:8px;border-radius:50%;background:#FF6B00;display:inline-block;"></span>' +
        '</div>' +
        '<h4>' + h(item.title) + '</h4>' +
        '<p>' + h(item.desc) + '</p>' +
      '</div>';
    }).join('');

    html = headerHtml + '<div class="svc-cards-grid-2">' + cardsHtml + '</div>';

  // 2. SERVICES CAPABILITIES TAB (6 Cards: 3-column grid)
  } else if (activeSubTab === 'services') {
    var sCards = (svc.servicesList || []).map(function(item) {
      return '<div class="svc-feature-card">' +
        '<div style="display:flex;align-items:flex-start;gap:16px;margin-bottom:12px;">' +
          checkIcon +
          '<h4>' + h(item.title) + '</h4>' +
        '</div>' +
        '<p style="padding-left:40px;">' + h(item.desc) + '</p>' +
      '</div>';
    }).join('');

    html = headerHtml + '<div class="svc-cards-grid-3">' + sCards + '</div>';

  // 3. BENEFITS TAB (6 Cards: 3-column grid)
  } else if (activeSubTab === 'benefits') {
    var bCards = (svc.benefitCards || []).map(function(item) {
      return '<div class="svc-feature-card">' +
        '<div style="display:flex;align-items:flex-start;gap:16px;margin-bottom:12px;">' +
          checkIcon +
          '<h4>' + h(item.title) + '</h4>' +
        '</div>' +
        '<p style="padding-left:40px;">' + h(item.desc) + '</p>' +
      '</div>';
    }).join('');

    html = headerHtml + '<div class="svc-cards-grid-3">' + bCards + '</div>';

  // 4. PROCESS TAB (6 Steps: 3-column grid)
  } else if (activeSubTab === 'process') {
    var stepsHtml = (svc.process || []).map(function(st) {
      return '<div class="svc-step-card">' +
        '<div style="display:flex;align-items:center;gap:16px;margin-bottom:12px;">' +
          '<span style="font-size:0.6875rem;font-weight:800;color:#0052FF;background:#EFF6FF;border:1px solid #DBEAFE;padding:3px 8px;border-radius:4px;">STEP ' + h(st.step) + '</span>' +
          '<h4 style="font-size:1.05rem;font-weight:700;color:#0F172A;margin:0;">' + h(st.title) + '</h4>' +
        '</div>' +
        '<p style="font-size:0.875rem;color:#475569;line-height:1.65;margin:0;">' + h(st.desc) + '</p>' +
      '</div>';
    }).join('');

    html = headerHtml + '<div class="svc-cards-grid-3">' + stepsHtml + '</div>';

  // 5. RESULTS TAB (6 Visibly Premium Light Blue Cards)
  } else if (activeSubTab === 'proven') {
    var rCards = (svc.resultCards || []).map(function(item) {
      return '<div class="svc-result-card">' +
        '<div style="display:flex;align-items:flex-start;gap:16px;margin-bottom:12px;">' +
          resultIcon +
          '<h4>' + h(item.title) + '</h4>' +
        '</div>' +
        '<p style="font-size:0.875rem;color:#334155;line-height:1.65;margin:0;padding-left:44px;">' + h(item.desc) + '</p>' +
      '</div>';
    }).join('');

    html = headerHtml + '<div class="svc-cards-grid-3">' + rCards + '</div>';
  }

  // Direct synchronous assignment
  pane.innerHTML = html;
}

function renderTechStack() {
  var svc = SVCS[activeSvcId];
  if (!svc) return;
  var grid = document.getElementById('techStackGrid');
  if (!grid) return;

  grid.innerHTML = (svc.techStack || []).map(function(t) {
    var iconSvg = TECH_ICONS[t.toUpperCase()] || TECH_ICONS[t] || null;
    var iconHtml = iconSvg ? '<div class="svc-tech-icon">' + iconSvg + '</div>' : '<div class="svc-tech-icon" style="background:#F1F5F9;border-radius:8px;font-size:11px;font-weight:800;color:#334155;">' + h(t.substring(0,3)) + '</div>';
    return '<div class="svc-tech-card">' +
      iconHtml +
      '<span class="svc-tech-name">' + h(t) + '</span>' +
    '</div>';
  }).join('');
}

// ================= SYNCHRONOUS IMMEDIATE INITIALIZATION & ROUTING =================
function getValidServiceIdFromHash() {
  var hash = window.location.hash
    .replace(/^#/, '')
    .trim()
    .toLowerCase();

  var aliases = {
    software: 'software-development',
    'ui-ux': 'ui-ux-design',
    mobile: 'mobile-application',
    'mobile-applications': 'mobile-application',
    cloud: 'cloud-infrastructure',
    database: 'database-management',
    web: 'web-development',
    ai: 'ai-automation',
    growth: 'digital-growth'
  };

  var candidate = hash;

  if (Object.prototype.hasOwnProperty.call(aliases, hash)) {
    candidate = aliases[hash];
  }

  if (ORDERED_SVCS.includes(candidate)) {
    return candidate;
  }

  return 'software-development';
}

function initServicesPage() {
  if (window.__servicesInitialized) return;
  window.__servicesInitialized = true;

  var initialId = getValidServiceIdFromHash();
  selectSvc(initialId, false);
  isInitialLoad = false;
}

// Execute immediately without waiting
initServicesPage();

window.addEventListener('resize', function() {
  updateCarouselArrows();
}, { passive: true });

window.addEventListener('hashchange', function() {
  var targetId = getValidServiceIdFromHash();
  if (targetId && targetId !== activeSvcId) {
    selectSvc(targetId, false);
  }
});

window.addEventListener('popstate', function() {
  var targetId = getValidServiceIdFromHash();
  if (targetId && targetId !== activeSvcId) {
    selectSvc(targetId, false);
  }
});
