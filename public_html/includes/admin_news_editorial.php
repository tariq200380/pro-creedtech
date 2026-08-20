<?php
/**
 * Creed Tech - Administrative News Editorial Drafts Component & UI
 */
require_once __DIR__ . '/csrf.php';
?>

<!-- ========================================================================= -->
<!-- 1. NEWS EDITORIAL DRAFTS MODAL WORKSPACE                                   -->
<!-- ========================================================================= -->
<div id="newsDraftEditorModal" class="admin-modal" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.8);z-index:99999;align-items:center;justify-content:center;padding:20px;backdrop-filter:blur(4px);">
  <div style="background:#FFFFFF;border-radius:12px;max-width:1150px;width:100%;max-height:92vh;display:flex;flex-direction:column;box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);border:1px solid #CBD5E1;overflow:hidden;">
    
    <!-- Modal Header -->
    <div style="background:#0F172A;color:#FFFFFF;padding:16px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #334155;">
      <div style="display:flex;align-items:center;gap:12px;">
        <span style="font-size:20px;">📰</span>
        <div>
          <h3 style="font-size:16px;font-weight:700;margin:0;color:#FFFFFF;">Knowledge Article Studio (From Source Reference)</h3>
          <span style="font-size:11px;color:#94A3B8;">Source reference is read-only. Write original Creed-Tech analysis &amp; insight.</span>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:12px;">
        <button type="button" onclick="returnToTechWire()" style="padding:6px 12px;background:#1E293B;color:#CBD5E1;border:1px solid #475569;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">← Return to Tech Wire</button>
        <button type="button" onclick="closeNewsDraftModal()" style="background:none;border:none;color:#94A3B8;font-size:24px;cursor:pointer;line-height:1;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94A3B8'">&times;</button>
      </div>
    </div>

    <!-- Modal Body: 2-Column Split Workspace -->
    <div style="padding:20px 24px;overflow-y:auto;flex:1;display:grid;grid-template-columns:360px 1fr;gap:24px;background:#F8FAFC;">
      
      <!-- LEFT COLUMN: SOURCE NEWS REFERENCE (READ ONLY) -->
      <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:8px;padding:18px;display:flex;flex-direction:column;gap:14px;box-shadow:0 1px 3px rgba(0,0,0,0.05);height:fit-content;">
        <div style="display:flex;align-items:center;justify-content:space-between;">
          <span style="font-size:11px;font-weight:800;letter-spacing:0.05em;color:#64748B;text-transform:uppercase;">SOURCE NEWS REFERENCE</span>
          <span id="draftSourceProviderBadge" style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:10px;background:#EFF6FF;color:#0052FF;border:1px solid #BFDBFE;">PROVIDER</span>
        </div>

        <!-- Verified Image -->
        <div style="border-radius:6px;overflow:hidden;background:#0F172A;height:160px;display:flex;align-items:center;justify-content:center;">
          <img id="draftSourceImage" src="" alt="Verified Source Image" style="width:100%;height:100%;object-fit:cover;">
        </div>

        <!-- Source Headline -->
        <div>
          <label style="font-size:11px;font-weight:700;color:#64748B;text-transform:uppercase;">Original Headline (Read-Only)</label>
          <h4 id="draftSourceTitle" style="font-size:14px;font-weight:700;color:#0F172A;line-height:1.4;margin:4px 0 0;"></h4>
        </div>

        <!-- Publication Meta -->
        <div>
          <label style="font-size:11px;font-weight:700;color:#64748B;text-transform:uppercase;">Published By Provider</label>
          <div id="draftSourceDate" style="font-size:12px;color:#334155;margin-top:2px;"></div>
        </div>

        <!-- Stable External Article ID (Read-Only) -->
        <div>
          <label style="font-size:11px;font-weight:700;color:#64748B;text-transform:uppercase;">External Article ID (Read-Only)</label>
          <div id="draftSourceExternalId" style="font-size:11px;font-family:monospace;color:#64748B;word-break:break-all;margin-top:2px;background:#F1F5F9;padding:4px 8px;border-radius:4px;"></div>
        </div>

        <!-- Writing Reference Summary -->
        <div>
          <label style="font-size:11px;font-weight:700;color:#64748B;text-transform:uppercase;">Source Summary Reference</label>
          <div id="draftSourceSummary" style="font-size:12px;color:#475569;line-height:1.5;margin-top:4px;padding:8px 10px;background:#F1F5F9;border-radius:4px;border-left:3px solid #0052FF;"></div>
        </div>

        <!-- Source Link -->
        <div style="padding-top:8px;border-top:1px solid #E2E8F0;">
          <a id="draftSourceUrl" href="#" target="_blank" rel="noopener noreferrer" style="font-size:12px;font-weight:600;color:#0052FF;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
            <span>Read Original Source Report</span> <span>↗</span>
          </a>
        </div>
      </div>

      <!-- RIGHT COLUMN: CREED-TECH ARTICLE (EDITABLE) -->
      <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:8px;padding:20px;display:flex;flex-direction:column;gap:16px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
        
        <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:12px;border-bottom:1px solid #F1F5F9;">
          <span style="font-size:11px;font-weight:800;letter-spacing:0.05em;color:#0052FF;text-transform:uppercase;">CREED-TECH ARTICLE (EDITABLE)</span>
          <div id="draftStatusPill" style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:12px;background:#FEF3C7;color:#92400E;">DRAFT</div>
        </div>

        <input type="hidden" id="draftEditId" value="">
        <input type="hidden" id="draftCsrfToken" value="<?php echo htmlspecialchars(get_csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">

        <!-- Custom Headline & Slug -->
        <div style="display:grid;grid-template-columns:2fr 1fr;gap:14px;">
          <div>
            <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Custom Article Headline <span style="color:#EF4444;">*</span></label>
            <input type="text" id="draftCustomTitle" oninput="autoGenerateSlug(this.value)" placeholder="e.g. Architectural Implications of OpenAI's Defender's Window..." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;outline:none;">
          </div>
          <div>
            <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Slug / URL Path</label>
            <input type="text" id="draftSlug" placeholder="article-slug" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;outline:none;font-family:monospace;">
          </div>
        </div>

        <!-- Custom Excerpt -->
        <div>
          <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Article Excerpt / Editor's Note</label>
          <textarea id="draftCustomExcerpt" rows="2" placeholder="Brief 1-2 sentence executive synopsis..." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;outline:none;resize:vertical;"></textarea>
        </div>

        <!-- Full Article Body (Starts Empty) -->
        <div>
          <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Full Article Body / Editorial Prose (Markdown / HTML) <span style="color:#EF4444;">*</span></label>
          <textarea id="draftCustomBody" rows="8" placeholder="Write your original Creed-Tech technical analysis, architectural review, and engineering recommendations in your own words..." style="width:100%;padding:10px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;line-height:1.6;outline:none;resize:vertical;font-family:inherit;"></textarea>
        </div>

        <!-- Category, Author & Tags Row -->
        <div style="display:grid;grid-template-columns:1.2fr 1fr 1fr;gap:14px;">
          <div>
            <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Category</label>
            <select id="draftCategory" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;outline:none;background:#fff;">
              <option value="ENTERPRISE TECH &amp; AI INTELLIGENCE">ENTERPRISE TECH &amp; AI INTELLIGENCE</option>
              <option value="GENERATIVE AI &amp; REASONING">GENERATIVE AI &amp; REASONING</option>
              <option value="HARDWARE &amp; SILICON">HARDWARE &amp; SILICON</option>
              <option value="CYBERSECURITY &amp; RESILIENCE">CYBERSECURITY &amp; RESILIENCE</option>
              <option value="PAKISTAN DIGITAL ECOSYSTEM">PAKISTAN DIGITAL ECOSYSTEM</option>
            </select>
          </div>
          <div>
            <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Author</label>
            <input type="text" id="draftAuthor" value="<?php echo htmlspecialchars($_SESSION['admin_email'] ?? 'Lead Architect', ENT_QUOTES, 'UTF-8'); ?>" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;outline:none;">
          </div>
          <div>
            <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Tags (Comma separated)</label>
            <input type="text" id="draftTags" placeholder="AI, Cloud, Architecture" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;outline:none;">
          </div>
        </div>

        <!-- SEO Metadata & Featured Checkbox -->
        <div style="display:grid;grid-template-columns:1.5fr 2fr auto;gap:14px;align-items:center;">
          <div>
            <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">SEO Title</label>
            <input type="text" id="draftSeoTitle" placeholder="Meta title tag..." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;outline:none;">
          </div>
          <div>
            <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">SEO Description</label>
            <input type="text" id="draftSeoDescription" placeholder="Meta description tag..." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;outline:none;">
          </div>
          <div style="padding-top:18px;">
            <label style="display:flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:#334155;cursor:pointer;">
              <input type="checkbox" id="draftIsFeatured">
              <span>Featured Article</span>
            </label>
          </div>
        </div>

        <!-- Cover Image Options -->
        <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:12px 14px;">
          <label style="font-size:12px;font-weight:700;color:#334155;display:block;margin-bottom:8px;">Cover Image Selection</label>
          <div style="display:flex;flex-direction:column;gap:8px;font-size:12px;color:#334155;">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
              <input type="radio" name="cover_image_choice" value="verified_source_image" checked onchange="toggleCoverUpload(this.value)">
              <span>Use Verified Source Image (with source attribution)</span>
            </label>
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
              <input type="radio" name="cover_image_choice" value="editorial_upload" onchange="toggleCoverUpload(this.value)">
              <span>Upload Custom Editorial Cover Image</span>
            </label>
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
              <input type="radio" name="cover_image_choice" value="none" onchange="toggleCoverUpload(this.value)">
              <span>No Cover Image</span>
            </label>
          </div>
          <div id="editorialUploadBox" style="display:none;margin-top:10px;">
            <input type="file" id="draftEditorialFile" accept="image/jpeg,image/png,image/webp" style="font-size:12px;">
          </div>
        </div>

      </div>

    </div>

    <!-- Modal Footer Actions -->
    <div style="background:#F1F5F9;padding:14px 24px;border-top:1px solid #E2E8F0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
      <div style="display:flex;gap:10px;">
        <button type="button" onclick="deleteCurrentDraft()" id="btnDeleteDraft" style="padding:8px 14px;background:#FEF2F2;color:#991B1B;border:1px solid #FECACA;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">Delete Draft</button>
        <button type="button" onclick="previewCurrentDraft()" style="padding:8px 14px;background:#EFF6FF;color:#0052FF;border:1px solid #BFDBFE;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">Preview In New Tab ↗</button>
      </div>
      <div style="display:flex;gap:10px;">
        <button type="button" onclick="returnToTechWire()" style="padding:8px 14px;background:#E2E8F0;color:#334155;border:none;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">← Return to Tech Wire</button>
        <button type="button" onclick="saveDraft(false)" style="padding:8px 18px;background:#0F172A;color:#FFFFFF;border:none;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">Save Draft</button>
        <button type="button" onclick="togglePublishDraft()" id="btnPublishDraft" style="padding:8px 18px;background:#0052FF;color:#FFFFFF;border:none;border-radius:4px;font-size:12px;font-weight:700;cursor:pointer;">Publish to Knowledge Center</button>
      </div>
    </div>

  </div>
</div>

<!-- ========================================================================= -->
<!-- 2. JAVASCRIPT LOGIC FOR NEWS EDITORIAL WORKFLOW                           -->
<!-- ========================================================================= -->
<script>
var ACTIVE_DRAFT_DATA = null;
var LIVE_NEWS_RAW = [];
var DRAFTS_MAP = {};

function toggleCoverUpload(val) {
  var box = document.getElementById('editorialUploadBox');
  if (box) box.style.display = (val === 'editorial_upload') ? 'block' : 'none';
}

function autoGenerateSlug(text) {
  var slugEl = document.getElementById('draftSlug');
  if (!slugEl || slugEl.dataset.manuallyEdited === 'true') return;
  var slug = (text || '').toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
  slugEl.value = slug.substring(0, 80);
}

function returnToTechWire() {
  closeNewsDraftModal();
  if (typeof switchAdminTab === 'function') {
    var newsWireBtn = document.querySelector('button[onclick*="news_wire"]');
    switchAdminTab('news_wire', newsWireBtn);
  }
}

async function refreshTechWireFeed(btn) {
  var button = btn || document.getElementById('btnRefreshTechWire');
  var origHtml = button ? button.innerHTML : 'Refresh Feed 🔄';

  if (button) {
    button.disabled = true;
    button.innerHTML = 'Refreshing... ⏳';
    button.style.opacity = '0.7';
    button.style.cursor = 'not-allowed';
  }

  var csrfToken = (document.getElementById('draftCsrfToken') ? document.getElementById('draftCsrfToken').value : (typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''));

  try {
    var res = await fetch('ajax/knowledge_news_drafts.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams({
        action: 'refresh_tech_wire_feeds',
        csrf_token: csrfToken
      })
    });

    var data = null;
    try {
      data = await res.json();
    } catch (e) {
      data = null;
    }

    if (res.ok && data && data.success === true) {
      // Reload and update the feed list
      await loadTechWireNewsTab();

      if (button) {
        button.innerHTML = 'Refreshed! ✅';
        setTimeout(function() {
          if (button) {
            button.disabled = false;
            button.innerHTML = origHtml;
            button.style.opacity = '1';
            button.style.cursor = 'pointer';
          }
        }, 1500);
      }
    } else {
      var errMsg = (data && (data.message || data.error)) ? (data.message || data.error) : ('Request failed (HTTP ' + res.status + ')');
      alert('Error refreshing feed: ' + errMsg);
      if (button) {
        button.disabled = false;
        button.innerHTML = origHtml;
        button.style.opacity = '1';
        button.style.cursor = 'pointer';
      }
    }
  } catch (err) {
    alert('Error refreshing feed: ' + (err.message || err));
    if (button) {
      button.disabled = false;
      button.innerHTML = origHtml;
      button.style.opacity = '1';
      button.style.cursor = 'pointer';
    }
  }
}

async function loadTechWireNewsTab() {
  var container = document.getElementById('adminTechWireList');
  if (!container) return;

  try {
    var res = await fetch('ajax/knowledge_news_drafts.php?action=list_feed_with_draft_status');
    if (!res.ok) throw new Error('HTTP ' + res.status);
    var data = await res.json();
    if (!data.success) throw new Error(data.error || 'Failed to fetch feeds');

    LIVE_NEWS_RAW = data.canonical_records || [];
    DRAFTS_MAP = data.draft_map || {};

    if (LIVE_NEWS_RAW.length === 0) {
      container.innerHTML = '<div style="padding:28px;text-align:center;color:#64748B;background:#FFFFFF;border:1px solid #E2E8F0;border-radius:8px;">No live tech news records found in canonical cache. <button onclick="loadTechWireNewsTab()" style="margin-left:8px;padding:4px 10px;background:#0052FF;color:#fff;border:none;border-radius:4px;cursor:pointer;">Retry 🔄</button></div>';
      return;
    }

    container.innerHTML = LIVE_NEWS_RAW.map(function(item) {
      var key = (item.provider || '').toLowerCase() + '|' + (item.external_id || '');
      var existingDraft = DRAFTS_MAP[key];
      var hasDraft = !!existingDraft;
      var draftStatus = hasDraft ? existingDraft.status : '';

      var btnLabel = hasDraft ? 'Open Knowledge Draft (' + draftStatus + ')' : '+ Create Knowledge Draft';
      var btnBg = hasDraft ? (draftStatus === 'PUBLISHED' ? '#10B981' : '#FF6B00') : '#0052FF';

      var imgSrc = item.img || 'Creed-Tech-Logo-Clean.webp';

      return `
        <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:8px;padding:16px;display:flex;gap:18px;align-items:flex-start;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
          <div style="width:140px;height:100px;background:#0F172A;border-radius:6px;overflow:hidden;flex-shrink:0;position:relative;">
            <img src="${imgSrc}" alt="" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='Creed-Tech-Logo-Clean.webp'">
          </div>
          <div style="flex:1;display:flex;flex-direction:column;gap:6px;">
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
              <span style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:10px;background:#EFF6FF;color:#0052FF;text-transform:uppercase;">${(item.provider || 'WIRE').toUpperCase()}</span>
              <span style="font-size:11px;color:#64748B;">${item.date || ''}</span>
              <span style="margin-left:auto;font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;padding:2px 6px;border-radius:4px;border:1px solid #A7F3D0;">VERIFIED FEED</span>
            </div>
            <h4 style="font-size:14px;font-weight:700;color:#0F172A;margin:0;line-height:1.4;">${item.title || ''}</h4>
            <p style="font-size:12px;color:#475569;margin:0;line-height:1.5;">${item.desc || ''}</p>
            <div style="display:flex;align-items:center;gap:12px;margin-top:8px;">
              <a href="${item.link || '#'}" target="_blank" rel="noopener noreferrer" style="font-size:11px;font-weight:600;color:#64748B;text-decoration:none;">Read Original ↗</a>
              <button onclick="handleCreateOrOpenDraft(this)" 
                data-provider="${item.provider || ''}" 
                data-extid="${item.external_id || ''}" 
                data-title="${(item.title || '').replace(/"/g, '&quot;')}" 
                data-link="${item.link || ''}" 
                data-img="${item.img || ''}" 
                data-date="${item.date || ''}" 
                data-desc="${(item.desc || '').replace(/"/g, '&quot;')}"
                style="margin-left:auto;padding:6px 14px;background:${btnBg};color:#FFFFFF;border:none;border-radius:4px;font-size:11px;font-weight:600;cursor:pointer;box-shadow:0 1px 2px rgba(0,0,0,0.1);">
                ${btnLabel}
              </button>
            </div>
          </div>
        </div>
      `;
    }).join('');

  } catch (err) {
    console.error('Failed to load tech wire news:', err);
  }
}

async function loadKnowledgeDraftsTab() {
  try {
    var res = await fetch('ajax/knowledge_news_drafts.php?action=list_drafts');
    var data = await res.json();
    if (!data.success) return;

    var drafts = data.drafts || [];
    var container = document.getElementById('adminNewsDraftsList');
    if (!container) return;

    if (drafts.length === 0) {
      container.innerHTML = '<div style="padding:24px;text-align:center;color:#64748B;background:#FFFFFF;border:1px solid #E2E8F0;border-radius:6px;grid-column: 1 / -1;">No news editorial drafts created yet. Visit the <strong>Tech Wire News</strong> tab and click "+ Create Knowledge Draft" on any source item.</div>';
      return;
    }

    container.innerHTML = drafts.map(function(d) {
      var isPub = (d.status === 'PUBLISHED');
      var statusBg = isPub ? '#ECFDF5' : '#FEF3C7';
      var statusColor = isPub ? '#065F46' : '#92400E';

      return `
        <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:8px;padding:16px;display:flex;flex-direction:column;gap:10px;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
          <div style="display:flex;align-items:center;justify-content:space-between;">
            <span style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:10px;background:#EFF6FF;color:#0052FF;">SOURCE: ${(d.source_provider || 'WIRE').toUpperCase()}</span>
            <span style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:10px;background:${statusBg};color:${statusColor};">${d.status || 'DRAFT'}</span>
          </div>
          <h4 style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">${d.custom_title || d.source_title || 'Untitled Draft'}</h4>
          <p style="font-size:12px;color:#64748B;margin:0;">Source: <em>${d.source_title || ''}</em></p>
          <div style="display:flex;gap:8px;margin-top:8px;padding-top:10px;border-top:1px solid #F1F5F9;flex-wrap:wrap;">
            <button onclick="openExistingDraft(${d.id})" style="flex:1;padding:6px;background:#0052FF;color:#fff;font-size:11px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">Edit in Studio</button>
            <button onclick="togglePublishInline(${d.id}, '${d.status || 'DRAFT'}')" style="padding:6px 10px;background:${isPub ? '#FEF3C7' : '#ECFDF5'};color:${isPub ? '#92400E' : '#065F46'};font-size:11px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">${isPub ? 'Unpublish' : 'Publish'}</button>
            <button onclick="deleteDraftInline(${d.id})" style="padding:6px 8px;background:#FEF2F2;color:#991B1B;font-size:11px;font-weight:600;border:1px solid #FECACA;border-radius:4px;cursor:pointer;">Delete</button>
            <a href="knowledge-center" target="_blank" style="padding:6px 10px;background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:600;border:1px solid #BFDBFE;border-radius:4px;text-decoration:none;">Preview ↗</a>
          </div>
        </div>
      `;
    }).join('');

  } catch (err) {
    console.error('Failed to load drafts:', err);
  }
}

async function handleCreateOrOpenDraft(targetOrProvider, encodedExtId) {
  var provider = '';
  var extId = '';
  var title = '';
  var link = '';
  var img = '';
  var pubDate = '';
  var summary = '';

  if (typeof targetOrProvider === 'object' && targetOrProvider !== null) {
    var btn = targetOrProvider;
    provider = btn.getAttribute('data-provider') || '';
    extId = btn.getAttribute('data-extid') || '';
    title = btn.getAttribute('data-title') || '';
    link = btn.getAttribute('data-link') || '';
    img = btn.getAttribute('data-img') || '';
    pubDate = btn.getAttribute('data-date') || '';
    summary = btn.getAttribute('data-desc') || '';
  } else {
    provider = targetOrProvider;
    extId = decodeURIComponent(encodedExtId || '');
    var found = LIVE_NEWS_RAW.find(function(n) {
      return (n.provider || '').toLowerCase() === (provider || '').toLowerCase() && (n.external_id || '') === extId;
    });
    if (found) {
      title = found.title || '';
      link = found.link || '';
      img = found.img || '';
      pubDate = found.date || '';
      summary = found.desc || '';
    }
  }

  if (!provider || !extId) {
    alert('Source news record identifiers not found.');
    return;
  }

  var csrfToken = document.getElementById('draftCsrfToken') ? document.getElementById('draftCsrfToken').value : '';

  try {
    var res = await fetch('ajax/knowledge_news_drafts.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        action: 'create_or_open_draft',
        csrf_token: csrfToken,
        provider: provider,
        external_id: extId,
        title: title,
        link: link,
        img: img,
        pub_date: pubDate,
        summary: summary
      })
    });

    var data = await res.json();
    if (data.success && data.draft) {
      populateAndOpenDraftModal(data.draft);
      loadTechWireNewsTab();
      loadKnowledgeDraftsTab();
    } else {
      alert('Error: ' + (data.error || 'Failed to initialize draft.'));
    }
  } catch (err) {
    console.error('Error creating draft:', err);
  }
}

async function openExistingDraft(draftId) {
  try {
    var res = await fetch('ajax/knowledge_news_drafts.php?action=get_draft&id=' + draftId);
    var data = await res.json();
    if (data.success && data.draft) {
      populateAndOpenDraftModal(data.draft);
    }
  } catch (err) {
    console.error('Error fetching draft:', err);
  }
}

function populateAndOpenDraftModal(draft) {
  ACTIVE_DRAFT_DATA = draft;

  document.getElementById('draftEditId').value = draft.id || '';
  document.getElementById('draftSourceProviderBadge').textContent = (draft.source_provider || 'SOURCE').toUpperCase();
  document.getElementById('draftSourceImage').src = draft.source_image_url || 'Creed-Tech-Logo-Clean.webp';
  document.getElementById('draftSourceTitle').textContent = draft.source_title || '';
  document.getElementById('draftSourceDate').textContent = draft.source_published_at || 'Recently Published';
  document.getElementById('draftSourceExternalId').textContent = draft.source_external_article_id || 'N/A';
  document.getElementById('draftSourceSummary').textContent = draft.source_summary_reference || 'Reference summary not provided.';
  document.getElementById('draftSourceUrl').href = draft.source_url || '#';

  document.getElementById('draftCustomTitle').value = draft.custom_title || '';
  document.getElementById('draftSlug').value = draft.slug || '';
  document.getElementById('draftCustomExcerpt').value = draft.custom_excerpt || '';
  document.getElementById('draftCustomBody').value = draft.custom_body || '';
  document.getElementById('draftCategory').value = draft.category || 'ENTERPRISE TECH & AI INTELLIGENCE';
  document.getElementById('draftAuthor').value = draft.author || '<?php echo htmlspecialchars($_SESSION['admin_email'] ?? 'Lead Architect', ENT_QUOTES, 'UTF-8'); ?>';
  document.getElementById('draftTags').value = Array.isArray(draft.tags) ? draft.tags.join(', ') : (draft.tags || '');
  document.getElementById('draftSeoTitle').value = draft.seo_title || '';
  document.getElementById('draftSeoDescription').value = draft.seo_description || '';
  document.getElementById('draftIsFeatured').checked = !!draft.is_featured;

  var isPub = (draft.status === 'PUBLISHED');
  var pill = document.getElementById('draftStatusPill');
  if (pill) {
    pill.textContent = draft.status || 'DRAFT';
    pill.style.background = isPub ? '#ECFDF5' : '#FEF3C7';
    pill.style.color = isPub ? '#065F46' : '#92400E';
  }

  var btnPub = document.getElementById('btnPublishDraft');
  if (btnPub) {
    btnPub.textContent = isPub ? 'Unpublish from Knowledge Center' : 'Publish to Knowledge Center';
    btnPub.style.background = isPub ? '#64748B' : '#0052FF';
  }

  var modal = document.getElementById('newsDraftEditorModal');
  if (modal) modal.style.display = 'flex';
}

function closeNewsDraftModal() {
  var modal = document.getElementById('newsDraftEditorModal');
  if (modal) modal.style.display = 'none';
}

async function saveDraft(andPublish) {
  if (!ACTIVE_DRAFT_DATA) return;

  var draftId = document.getElementById('draftEditId').value;
  var customTitle = document.getElementById('draftCustomTitle').value;
  var slug = document.getElementById('draftSlug').value;
  var customExcerpt = document.getElementById('draftCustomExcerpt').value;
  var customBody = document.getElementById('draftCustomBody').value;
  var category = document.getElementById('draftCategory').value;
  var author = document.getElementById('draftAuthor').value;
  var tags = document.getElementById('draftTags').value.split(',').map(function(t) { return t.trim(); }).filter(Boolean);
  var seoTitle = document.getElementById('draftSeoTitle').value;
  var seoDesc = document.getElementById('draftSeoDescription').value;
  var isFeatured = document.getElementById('draftIsFeatured').checked;
  var csrfToken = document.getElementById('draftCsrfToken').value;

  var coverChoice = 'verified_source_image';
  var radios = document.getElementsByName('cover_image_choice');
  for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) coverChoice = radios[i].value;
  }

  var payload = {
    action: 'save_draft',
    csrf_token: csrfToken,
    id: draftId,
    custom_title: customTitle,
    slug: slug,
    custom_excerpt: customExcerpt,
    custom_body: customBody,
    category: category,
    author: author,
    tags: tags,
    seo_title: seoTitle,
    seo_description: seoDesc,
    is_featured: isFeatured,
    cover_image_type: coverChoice
  };

  try {
    var res = await fetch('ajax/knowledge_news_drafts.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    var data = await res.json();
    if (data.success) {
      ACTIVE_DRAFT_DATA = data.draft;
      alert('Draft saved successfully.');
      loadKnowledgeDraftsTab();
    } else {
      alert('Error: ' + (data.error || 'Failed to save draft.'));
    }
  } catch (err) {
    console.error('Save error:', err);
  }
}

async function togglePublishDraft() {
  if (!ACTIVE_DRAFT_DATA) return;
  var isPub = (ACTIVE_DRAFT_DATA.status === 'PUBLISHED');
  var actionName = isPub ? 'unpublish_draft' : 'publish_draft';
  var csrfToken = document.getElementById('draftCsrfToken').value;
  var draftId = document.getElementById('draftEditId').value;

  await saveDraft(false);

  try {
    var res = await fetch('ajax/knowledge_news_drafts.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        action: actionName,
        csrf_token: csrfToken,
        id: draftId
      })
    });
    var data = await res.json();
    if (data.success) {
      ACTIVE_DRAFT_DATA = data.draft;
      populateAndOpenDraftModal(data.draft);
      loadKnowledgeDraftsTab();
      loadTechWireNewsTab();
      alert(data.message);
    } else {
      alert('Error: ' + (data.error || 'Publish toggle failed.'));
    }
  } catch (err) {
    console.error('Publish error:', err);
  }
}

async function togglePublishInline(draftId, currentStatus) {
  var isPub = (currentStatus === 'PUBLISHED');
  var actionName = isPub ? 'unpublish_draft' : 'publish_draft';
  var csrfToken = document.getElementById('draftCsrfToken') ? document.getElementById('draftCsrfToken').value : '';

  try {
    var res = await fetch('ajax/knowledge_news_drafts.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        action: actionName,
        csrf_token: csrfToken,
        id: draftId
      })
    });
    var data = await res.json();
    if (data.success) {
      loadKnowledgeDraftsTab();
      loadTechWireNewsTab();
      alert(data.message);
    } else {
      alert('Error: ' + (data.error || 'Operation failed.'));
    }
  } catch (err) {
    console.error('Inline publish error:', err);
  }
}

async function deleteDraftInline(draftId) {
  if (!confirm('Are you sure you want to delete this Knowledge Draft? The source news record will remain untouched.')) return;
  var csrfToken = document.getElementById('draftCsrfToken') ? document.getElementById('draftCsrfToken').value : '';

  try {
    var res = await fetch('ajax/knowledge_news_drafts.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        action: 'delete_draft',
        csrf_token: csrfToken,
        id: draftId
      })
    });
    var data = await res.json();
    if (data.success) {
      loadKnowledgeDraftsTab();
      loadTechWireNewsTab();
      alert(data.message);
    } else {
      alert('Error: ' + (data.error || 'Delete failed.'));
    }
  } catch (err) {
    console.error('Inline delete error:', err);
  }
}

async function deleteCurrentDraft() {
  if (!ACTIVE_DRAFT_DATA) return;
  if (!confirm('Are you sure you want to delete this Knowledge Draft? The source news record will remain untouched.')) return;

  var csrfToken = document.getElementById('draftCsrfToken').value;
  var draftId = document.getElementById('draftEditId').value;

  try {
    var res = await fetch('ajax/knowledge_news_drafts.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        action: 'delete_draft',
        csrf_token: csrfToken,
        id: draftId
      })
    });
    var data = await res.json();
    if (data.success) {
      closeNewsDraftModal();
      loadTechWireNewsTab();
      loadKnowledgeDraftsTab();
      alert(data.message);
    } else {
      alert('Error: ' + (data.error || 'Delete failed.'));
    }
  } catch (err) {
    console.error('Delete error:', err);
  }
}

function previewCurrentDraft() {
  window.open('knowledge-center', '_blank');
}

document.addEventListener('DOMContentLoaded', function() {
  loadTechWireNewsTab();
  loadKnowledgeDraftsTab();
});
</script>
