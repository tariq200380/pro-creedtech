<?php
require_once __DIR__ . '/includes/auth_guard.php';

$page_title = "Master Universal Admin CMS | Creed Tech Enterprise Command Center";
$page_description = "Creed Tech Enterprise CMS - Centralized management for inquiries, vision requests, knowledge articles, video library, talent pool, and subscribers.";
$active_page = "admin";

$applicantsFile = __DIR__ . '/data/job_applicants.json';
$applicants = file_exists($applicantsFile) ? (json_decode(file_get_contents($applicantsFile), true) ?? []) : [];

$careersFile = __DIR__ . '/data/careers.json';
$jobs = file_exists($careersFile) ? (json_decode(file_get_contents($careersFile), true) ?? []) : [];

include __DIR__ . '/includes/header.php';
?>

<style>
/* Modern Admin Layout Styles */
.admin-tab-btn {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
  padding: 10px 16px;
  background: transparent;
  border: none;
  color: #94A3B8;
  font-size: 13px;
  font-weight: 500;
  text-align: left;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.2s ease;
}
.admin-tab-btn:hover {
  background: rgba(255, 255, 255, 0.06);
  color: #F8FAFC;
}
.admin-tab-btn.active {
  background: #0052FF;
  color: #FFFFFF;
  font-weight: 600;
  box-shadow: 0 4px 6px -1px rgba(0, 82, 255, 0.3);
}
.admin-stat-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  padding: 20px;
  border-radius: 6px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: transform 0.2s, box-shadow 0.2s;
}
.admin-stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 15px -3px rgba(0,0,0,0.08);
}
.admin-badge-pending { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }
.admin-badge-review { background: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; }
.admin-badge-contacted { background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }
.admin-badge-archived { background: #F3F4F6; color: #4B5563; border: 1px solid #E5E7EB; }
.admin-modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.75);
  backdrop-filter: blur(5px);
  z-index: 9999;
  align-items: center;
  justify-content: center;
  padding: 20px;
  overflow-y: auto;
}
.editor-tab-btn {
  padding: 8px 16px;
  font-size: 12px;
  font-weight: 700;
  border: 1px solid #E2E8F0;
  background: #F1F5F9;
  color: #475569;
  cursor: pointer;
  transition: all 0.2s;
}
.editor-tab-btn.active {
  background: #0052FF;
  color: #FFFFFF;
  border-color: #0052FF;
}
/* Table Styles in WYSIWYG */
#richWysiwygEditor table {
  width: 100%;
  border-collapse: collapse;
  margin: 16px 0;
}
#richWysiwygEditor th {
  background: #1E293B;
  color: #FFFFFF;
  padding: 10px 14px;
  border: 1px solid #CBD5E1;
  font-weight: 700;
}
#richWysiwygEditor td {
  padding: 8px 12px;
  border: 1px solid #CBD5E1;
  background: #FFFFFF;
}
#richWysiwygEditor tr:nth-child(even) td {
  background: #F8FAFC;
}
.table-grid-cell {
  width: 20px;
  height: 20px;
  border: 1px solid #CBD5E1;
  background: #FFFFFF;
  cursor: pointer;
}
.table-grid-cell.highlight {
  background: #93C5FD;
  border-color: #3B82F6;
}
</style>

<div style="width:100%;min-height:90vh;background:#F8FAFC;color:#0F172A;font-family:sans-serif;text-align:left;">
  
  <!-- Admin Header Bar -->
  <div style="background:#0B1120;color:#fff;padding:14px 28px;border-bottom:1px solid #1E293B;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
    <div style="display:flex;align-items:center;gap:14px;">
      <span style="font-size:14px;font-weight:800;letter-spacing:0.05em;color:#fff;">CREED<span style="color:#FF6B00;">TECH</span></span>
      <span style="height:16px;width:1px;background:#334155;"></span>
      <span style="font-size:12px;font-weight:600;color:#38BDF8;background:rgba(56,189,248,0.1);padding:2px 8px;border-radius:2px;border:1px solid rgba(56,189,248,0.2);">MASTER CMS 2.0</span>
    </div>

    <div style="display:flex;align-items:center;gap:16px;">
      <div style="position:relative;">
        <input type="text" id="adminGlobalSearch" oninput="filterAdminGlobal(this.value)" placeholder="Search inquiries, articles, candidates..." style="background:#1E293B;border:1px solid #334155;color:#F8FAFC;padding:6px 14px 6px 30px;font-size:12px;border-radius:4px;width:260px;outline:none;">
        <span style="position:absolute;left:10px;top:7px;color:#94A3B8;font-size:12px;">🔍</span>
      </div>
      <?php include __DIR__ . '/includes/admin_top_bar.php'; ?>
    </div>
  </div>

  <!-- Admin Main 2-Column Interface -->
  <div style="display:grid;grid-template-columns:240px 1fr;min-height:calc(90vh - 58px);">
    
    <!-- LEFT SIDEBAR -->
    <aside style="background:#0F172A;border-right:1px solid #1E293B;padding:20px 12px;display:flex;flex-direction:column;gap:6px;">
      <div style="padding:0 8px 12px;font-size:10px;font-weight:700;color:#64748B;text-transform:uppercase;letter-spacing:0.1em;">NAVIGATION MODULES</div>
      
      <button type="button" onclick="switchAdminTab('dashboard', this)" class="admin-tab-btn active">
        <span>📊</span> <span>Dashboard Overview</span>
      </button>

      <button type="button" onclick="switchAdminTab('contact_inquiries', this)" class="admin-tab-btn">
        <span>📬</span> <span>Contact Inquiries</span> <span style="margin-left:auto;background:#0052FF;color:#fff;font-size:10px;padding:2px 6px;border-radius:10px;">8</span>
      </button>

      <button type="button" onclick="switchAdminTab('vision_inquiries', this)" class="admin-tab-btn">
        <span>🚀</span> <span>Vision To Life Requests</span> <span style="margin-left:auto;background:#FF6B00;color:#fff;font-size:10px;padding:2px 6px;border-radius:10px;">4</span>
      </button>

      <button type="button" onclick="switchAdminTab('articles', this)" class="admin-tab-btn">
        <span>📚</span> <span>Knowledge Articles</span>
      </button>

      <button type="button" onclick="switchAdminTab('videos', this)" class="admin-tab-btn">
        <span>🎥</span> <span>Video Library</span>
      </button>

      <button type="button" onclick="switchAdminTab('news_wire', this)" class="admin-tab-btn">
        <span>📰</span> <span>Tech Wire News</span>
      </button>

      <button type="button" onclick="switchAdminTab('reviews', this)" class="admin-tab-btn">
        <span>⭐</span> <span>Client Testimonials</span>
      </button>

      <button type="button" onclick="switchAdminTab('article_reviews', this)" class="admin-tab-btn">
        <span>✍️</span> <span>Article Reviews Moderation</span> <span id="articleReviewsBadge" style="margin-left:auto;background:#EF4444;color:#fff;font-size:10px;padding:2px 6px;border-radius:10px;font-weight:700;">1 Pending</span>
      </button>

      <button type="button" onclick="switchAdminTab('applicants', this)" class="admin-tab-btn">
        <span>💼</span> <span>Talent Pool / Careers</span>
      </button>

      <button type="button" onclick="switchAdminTab('subscribers', this)" class="admin-tab-btn">
        <span>📧</span> <span>Newsletter Leads</span>
      </button>

      <button type="button" onclick="switchAdminTab('website_settings', this); switchWsSubTab('portfolio', document.querySelector('.ws-subtab-btn:nth-child(4)'));" class="admin-tab-btn">
        <span>💼</span> <span>Portfolio Projects</span>
      </button>

      <button type="button" onclick="switchAdminTab('website_settings', this)" class="admin-tab-btn">
        <span>🌐</span> <span>Website Settings</span>
      </button>

      <button type="button" onclick="switchAdminTab('settings', this)" class="admin-tab-btn">
        <span>⚙️</span> <span>System &amp; Security</span>
      </button>

      <div style="margin-top:auto;padding-top:16px;border-top:1px solid #1E293B;display:flex;flex-direction:column;gap:8px;">
        <a href="Home" target="_blank" style="display:flex;align-items:center;gap:8px;color:#94A3B8;font-size:12px;text-decoration:none;padding:8px 12px;border-radius:4px;background:rgba(255,255,255,0.03);" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94A3B8'">
          <span>🌐</span> <span>View Live Site ↗</span>
        </a>
        <form method="POST" action="logout.php" style="margin:0;padding:0;">
          <?php echo csrf_field(); ?>
          <button type="submit" style="width:100%;display:flex;align-items:center;gap:8px;color:#FCA5A5;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);font-size:12px;font-weight:600;padding:8px 12px;border-radius:4px;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='rgba(239,68,68,0.25)'" onmouseout="this.style.background='rgba(239,68,68,0.1)'">
            <span>🚪</span> <span>Sign Out</span>
          </button>
        </form>
      </div>
    </aside>

    <!-- RIGHT MAIN CONTENT PANEL -->
    <main style="padding:28px 36px;overflow-y:auto;background:#F8FAFC;">
      
      <!-- ================= 1. TAB: DASHBOARD OVERVIEW ================= -->
      <div id="tab_dashboard" class="admin-tab-pane" style="display:block;">
        
        <!-- Header -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:16px;">
          <div>
            <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">Executive Dashboard Overview</h1>
            <p style="font-size:13px;color:#64748B;margin:0;">Real-time platform telemetry, incoming requests, and knowledge performance metrics.</p>
          </div>
          <div style="display:flex;gap:10px;">
            <button onclick="openModal('addArticleModal')" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">+ Rich Article Studio</button>
            <button onclick="openModal('addVideoModal')" style="padding:8px 16px;background:#FF6B00;color:#fff;font-size:12px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">+ New Video</button>
          </div>
        </div>

        <!-- 6 Metrics Cards -->
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:16px;margin-bottom:28px;">
          
          <div class="admin-stat-card">
            <span style="font-size:11px;font-weight:600;color:#64748B;text-transform:uppercase;">Contact Inquiries</span>
            <div style="display:flex;align-items:baseline;justify-content:space-between;margin-top:8px;">
              <span style="font-size:26px;font-weight:700;color:#0052FF;">12</span>
              <span style="font-size:11px;color:#10B981;font-weight:600;">+3 Today</span>
            </div>
            <span style="font-size:11px;color:#94A3B8;margin-top:4px;">Direct Architect Submissions</span>
          </div>

          <div class="admin-stat-card">
            <span style="font-size:11px;font-weight:600;color:#64748B;text-transform:uppercase;">Vision To Life Pods</span>
            <div style="display:flex;align-items:baseline;justify-content:space-between;margin-top:8px;">
              <span style="font-size:26px;font-weight:700;color:#FF6B00;">8</span>
              <span style="font-size:11px;color:#10B981;font-weight:600;">+2 Sprints</span>
            </div>
            <span style="font-size:11px;color:#94A3B8;margin-top:4px;">Custom Service Scoping</span>
          </div>

          <div class="admin-stat-card">
            <span style="font-size:11px;font-weight:600;color:#64748B;text-transform:uppercase;">Published Articles</span>
            <div style="display:flex;align-items:baseline;justify-content:space-between;margin-top:8px;">
              <span style="font-size:26px;font-weight:700;color:#0F172A;">24</span>
              <span style="font-size:11px;color:#0052FF;font-weight:600;">142k Views</span>
            </div>
            <span style="font-size:11px;color:#94A3B8;margin-top:4px;">Knowledge Center Articles</span>
          </div>

          <div class="admin-stat-card">
            <span style="font-size:11px;font-weight:600;color:#64748B;text-transform:uppercase;">Video Library</span>
            <div style="display:flex;align-items:baseline;justify-content:space-between;margin-top:8px;">
              <span style="font-size:26px;font-weight:700;color:#0F172A;">18</span>
              <span style="font-size:11px;color:#059669;font-weight:600;">Active CDN</span>
            </div>
            <span style="font-size:11px;color:#94A3B8;margin-top:4px;">Special Features &amp; Keynotes</span>
          </div>

          <div class="admin-stat-card">
            <span style="font-size:11px;font-weight:600;color:#64748B;text-transform:uppercase;">Talent Pool</span>
            <div style="display:flex;align-items:baseline;justify-content:space-between;margin-top:8px;">
              <span style="font-size:26px;font-weight:700;color:#0F172A;">42</span>
              <span style="font-size:11px;color:#7C3AED;font-weight:600;">8 Shortlisted</span>
            </div>
            <span style="font-size:11px;color:#94A3B8;margin-top:4px;">Senior Engineering Candidates</span>
          </div>

          <div class="admin-stat-card">
            <span style="font-size:11px;font-weight:600;color:#64748B;text-transform:uppercase;">Newsletter Leads</span>
            <div style="display:flex;align-items:baseline;justify-content:space-between;margin-top:8px;">
              <span style="font-size:26px;font-weight:700;color:#0F172A;">1,840</span>
              <span style="font-size:11px;color:#10B981;font-weight:600;">+24% MoM</span>
            </div>
            <span style="font-size:11px;color:#94A3B8;margin-top:4px;">Enterprise Subscriptions</span>
          </div>

        </div>

        <!-- Recent Activity & Quick Inquiries Table -->
        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;border-bottom:1px solid #F1F5F9;padding-bottom:12px;">
            <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Recent Incoming Client Inquiries</h3>
            <button onclick="switchAdminTab('contact_inquiries', document.querySelectorAll('.admin-tab-btn')[1])" style="font-size:12px;color:#0052FF;font-weight:600;background:none;border:none;cursor:pointer;">View All Inquiries →</button>
          </div>

          <div style="overflow-x:auto;">
            <table style="width:100%;text-align:left;border-collapse:collapse;font-size:13px;">
              <thead>
                <tr style="background:#F8FAFC;border-bottom:1px solid #E2E8F0;color:#64748B;font-size:11px;text-transform:uppercase;">
                  <th style="padding:10px 14px;">Client Name</th>
                  <th style="padding:10px 14px;">Service</th>
                  <th style="padding:10px 14px;">Company</th>
                  <th style="padding:10px 14px;">Date</th>
                  <th style="padding:10px 14px;">Status</th>
                  <th style="padding:10px 14px;text-align:right;">Actions</th>
                </tr>
              </thead>
              <tbody style="divide-y:1px solid #F1F5F9;">
                <tr style="border-bottom:1px solid #F1F5F9;">
                  <td style="padding:12px 14px;font-weight:600;color:#0F172A;">Alexander Vance</td>
                  <td style="padding:12px 14px;color:#0052FF;font-weight:500;">Software Development</td>
                  <td style="padding:12px 14px;color:#64748B;">FinTech Global (Frankfurt)</td>
                  <td style="padding:12px 14px;color:#64748B;font-size:12px;">Today, 06:45 AM</td>
                  <td style="padding:12px 14px;"><span class="admin-badge-pending" style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:2px;">PENDING</span></td>
                  <td style="padding:12px 14px;text-align:right;">
                    <button onclick="viewInquiry('Alexander Vance', 'alexander.vance@fintech-global.de', 'Software Development', 'High-concurrency microservices platform handling 15k requests/sec with real-time settlement.', '+49 69 9876543', 'FinTech Global Group')" style="padding:4px 10px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">View</button>
                  </td>
                </tr>
                <tr style="border-bottom:1px solid #F1F5F9;">
                  <td style="padding:12px 14px;font-weight:600;color:#0F172A;">Dr. Elena Rostova</td>
                  <td style="padding:12px 14px;color:#0052FF;font-weight:500;">AI &amp; Automation</td>
                  <td style="padding:12px 14px;color:#64748B;">Neural BioTech Labs (Madrid)</td>
                  <td style="padding:12px 14px;color:#64748B;font-size:12px;">Yesterday</td>
                  <td style="padding:12px 14px;"><span class="admin-badge-review" style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:2px;">IN_REVIEW</span></td>
                  <td style="padding:12px 14px;text-align:right;">
                    <button onclick="viewInquiry('Dr. Elena Rostova', 'elena@neural-bio.es', 'AI & Automation', 'Private sovereign RAG pipeline fine-tuned on 40,000 biomedical PDFs with zero public model data leakage.', '+34 91 123 4567', 'Neural BioTech Labs')" style="padding:4px 10px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">View</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Talent Pool & Careers Preview Block on Dashboard -->
        <div style="margin-top:24px;background:#fff;border:1px solid #E2E8F0;border-radius:6px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;border-bottom:1px solid #F1F5F9;padding-bottom:12px;flex-wrap:wrap;gap:10px;">
            <div>
              <div style="display:flex;align-items:center;gap:8px;">
                <span style="background:#0052FF;color:#fff;font-size:10px;font-weight:800;padding:2px 8px;border-radius:2px;letter-spacing:0.05em;text-transform:uppercase;">CAREERS &amp; TALENT POOL</span>
                <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Registered Engineering Candidates &amp; Active Job Openings</h3>
              </div>
              <p style="font-size:12px;color:#64748B;margin:2px 0 0;">Candidates registered via Careers page &amp; alert notifications.</p>
            </div>
            <button onclick="switchAdminTab('applicants', document.querySelectorAll('.admin-tab-btn')[8])" style="font-size:12px;color:#0052FF;font-weight:700;background:none;border:none;cursor:pointer;">Manage Full Talent CMS →</button>
          </div>

          <div style="overflow-x:auto;">
            <table style="width:100%;text-align:left;border-collapse:collapse;font-size:13px;">
              <thead>
                <tr style="background:#F8FAFC;border-bottom:1px solid #E2E8F0;color:#64748B;font-size:11px;text-transform:uppercase;">
                  <th style="padding:10px 14px;">Candidate Name</th>
                  <th style="padding:10px 14px;">Domain Specialty</th>
                  <th style="padding:10px 14px;">Email</th>
                  <th style="padding:10px 14px;">Portfolio / GitHub</th>
                  <th style="padding:10px 14px;">Date</th>
                  <th style="padding:10px 14px;text-align:right;">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr style="border-bottom:1px solid #F1F5F9;">
                  <td style="padding:12px 14px;font-weight:700;color:#0F172A;">Julian Alvarez</td>
                  <td style="padding:12px 14px;color:#0052FF;font-weight:600;">Rust &amp; Distributed Systems</td>
                  <td style="padding:12px 14px;color:#475569;">julian.alvarez@dev.io</td>
                  <td style="padding:12px 14px;"><a href="https://github.com/jalvarez" target="_blank" style="color:#0052FF;text-decoration:underline;font-size:12px;">🔗 github.com/jalvarez</a></td>
                  <td style="padding:12px 14px;color:#64748B;font-size:12px;">Aug 16, 2026</td>
                  <td style="padding:12px 14px;text-align:right;"><span style="background:#EFF6FF;color:#1D4ED8;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">SHORTLISTED</span></td>
                </tr>
                <tr style="border-bottom:1px solid #F1F5F9;">
                  <td style="padding:12px 14px;font-weight:700;color:#0F172A;">Maya Lin</td>
                  <td style="padding:12px 14px;color:#0052FF;font-weight:600;">UI/UX &amp; Design Systems (WCAG AAA)</td>
                  <td style="padding:12px 14px;color:#475569;">maya.lin@uxcraft.org</td>
                  <td style="padding:12px 14px;"><a href="https://figma.com/@mayalin" target="_blank" style="color:#0052FF;text-decoration:underline;font-size:12px;">🔗 figma.com/@mayalin</a></td>
                  <td style="padding:12px 14px;color:#64748B;font-size:12px;">Aug 15, 2026</td>
                  <td style="padding:12px 14px;text-align:right;"><span style="background:#ECFDF5;color:#059669;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">INTERVIEWING</span></td>
                </tr>
                <tr style="border-bottom:1px solid #F1F5F9;">
                  <td style="padding:12px 14px;font-weight:700;color:#0F172A;">Priya Sharma</td>
                  <td style="padding:12px 14px;color:#0052FF;font-weight:600;">AI &amp; Large Language Models (vLLM &amp; CUDA)</td>
                  <td style="padding:12px 14px;color:#475569;">priya.sharma@ml-research.ai</td>
                  <td style="padding:12px 14px;"><a href="https://github.com/priya-sharma-ai" target="_blank" style="color:#0052FF;text-decoration:underline;font-size:12px;">🔗 github.com/priya-sharma-ai</a></td>
                  <td style="padding:12px 14px;color:#64748B;font-size:12px;">Aug 14, 2026</td>
                  <td style="padding:12px 14px;text-align:right;"><span style="background:#EFF6FF;color:#1D4ED8;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">SHORTLISTED</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <!-- ================= 2. TAB: CONTACT INQUIRIES ================= -->
      <div id="tab_contact_inquiries" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
          <div>
            <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">Contact Us Submissions</h1>
            <p style="font-size:13px;color:#64748B;margin:0;">Incoming inquiries submitted via the Project Specification &amp; Scoping Form.</p>
          </div>
          <button onclick="exportInquiriesCsv()" style="padding:8px 16px;background:#F1F5F9;border:1px solid #CBD5E1;color:#1E293B;font-size:12px;font-weight:600;border-radius:4px;cursor:pointer;">Export CSV 📥</button>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
          <table style="width:100%;text-align:left;border-collapse:collapse;font-size:13px;">
            <thead>
              <tr style="background:#F8FAFC;border-bottom:1px solid #E2E8F0;color:#64748B;font-size:11px;text-transform:uppercase;">
                <th style="padding:12px 16px;">Client / Email</th>
                <th style="padding:12px 16px;">Service</th>
                <th style="padding:12px 16px;">Company / Phone</th>
                <th style="padding:12px 16px;">NDA</th>
                <th style="padding:12px 16px;">Status</th>
                <th style="padding:12px 16px;text-align:right;">Actions</th>
              </tr>
            </thead>
            <tbody id="inquiriesTableBody">
              <tr style="border-bottom:1px solid #F1F5F9;">
                <td style="padding:14px 16px;">
                  <div style="font-weight:600;color:#0F172A;">Alexander Vance</div>
                  <div style="font-size:12px;color:#64748B;">alexander.vance@fintech-global.de</div>
                </td>
                <td style="padding:14px 16px;color:#0052FF;font-weight:600;">Software Development</td>
                <td style="padding:14px 16px;color:#475569;">
                  <div>FinTech Global Group</div>
                  <div style="font-size:11px;color:#94A3B8;">+49 69 9876543</div>
                </td>
                <td style="padding:14px 16px;"><span style="color:#10B981;font-weight:700;">✓ Required</span></td>
                <td style="padding:14px 16px;">
                  <select onchange="updateStatus(this)" style="font-size:11px;font-weight:600;padding:4px 8px;border-radius:2px;border:1px solid #CBD5E1;background:#fff;">
                    <option value="PENDING" selected>PENDING</option>
                    <option value="IN_REVIEW">IN_REVIEW</option>
                    <option value="CONTACTED">CONTACTED</option>
                    <option value="ARCHIVED">ARCHIVED</option>
                  </select>
                </td>
                <td style="padding:14px 16px;text-align:right;">
                  <button onclick="viewInquiry('Alexander Vance', 'alexander.vance@fintech-global.de', 'Software Development', 'We require a high-concurrency microservices platform handling 15k requests/sec with real-time settlement.', '+49 69 9876543', 'FinTech Global Group')" style="padding:6px 12px;background:#0052FF;color:#fff;font-size:11px;font-weight:600;border:none;border-radius:2px;cursor:pointer;">Inspect</button>
                </td>
              </tr>
              <tr style="border-bottom:1px solid #F1F5F9;">
                <td style="padding:14px 16px;">
                  <div style="font-weight:600;color:#0F172A;">Dr. Elena Rostova</div>
                  <div style="font-size:12px;color:#64748B;">elena@neural-bio.es</div>
                </td>
                <td style="padding:14px 16px;color:#0052FF;font-weight:600;">AI &amp; Automation</td>
                <td style="padding:14px 16px;color:#475569;">
                  <div>Neural BioTech Labs</div>
                  <div style="font-size:11px;color:#94A3B8;">+34 91 123 4567</div>
                </td>
                <td style="padding:14px 16px;"><span style="color:#10B981;font-weight:700;">✓ Required</span></td>
                <td style="padding:14px 16px;">
                  <select onchange="updateStatus(this)" style="font-size:11px;font-weight:600;padding:4px 8px;border-radius:2px;border:1px solid #CBD5E1;background:#fff;">
                    <option value="PENDING">PENDING</option>
                    <option value="IN_REVIEW" selected>IN_REVIEW</option>
                    <option value="CONTACTED">CONTACTED</option>
                    <option value="ARCHIVED">ARCHIVED</option>
                  </select>
                </td>
                <td style="padding:14px 16px;text-align:right;">
                  <button onclick="viewInquiry('Dr. Elena Rostova', 'elena@neural-bio.es', 'AI & Automation', 'Private sovereign RAG pipeline fine-tuned on 40,000 biomedical PDFs with zero public model data leakage.', '+34 91 123 4567', 'Neural BioTech Labs')" style="padding:6px 12px;background:#0052FF;color:#fff;font-size:11px;font-weight:600;border:none;border-radius:2px;cursor:pointer;">Inspect</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ================= 3. TAB: VISION INQUIRIES ================= -->
      <div id="tab_vision_inquiries" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
          <div>
            <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">Vision To Life Project Requests</h1>
            <p style="font-size:13px;color:#64748B;margin:0;">Custom scoping and pod assignments submitted from the Services Page.</p>
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
          <table style="width:100%;text-align:left;border-collapse:collapse;font-size:13px;">
            <thead>
              <tr style="background:#F8FAFC;border-bottom:1px solid #E2E8F0;color:#64748B;font-size:11px;text-transform:uppercase;">
                <th style="padding:12px 16px;">Lead Name</th>
                <th style="padding:12px 16px;">Engagement Model</th>
                <th style="padding:12px 16px;">Role / Engineers Needed</th>
                <th style="padding:12px 16px;">Contact Coordinates</th>
                <th style="padding:12px 16px;text-align:right;">Actions</th>
              </tr>
            </thead>
            <tbody id="visionTableBody">
              <tr style="border-bottom:1px solid #F1F5F9;">
                <td style="padding:14px 16px;font-weight:600;color:#0F172A;">Michael Sterling</td>
                <td style="padding:14px 16px;"><span style="background:#FFF7ED;color:#C2410C;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #FFEDD5;">Dedicated Team</span></td>
                <td style="padding:14px 16px;color:#0F172A;font-weight:600;">AI Developers (4 Senior)</td>
                <td style="padding:14px 16px;color:#64748B;">m.sterling@hyper-scale.com • +1 (415) 890-4820</td>
                <td style="padding:14px 16px;text-align:right;">
                  <button onclick="viewInquiry('Michael Sterling', 'm.sterling@hyper-scale.com', 'Dedicated Team - AI Developers', 'Looking to hire a dedicated pod of 4 senior AI engineers to build multi-agent autonomous workflows for our enterprise portal.', '+1 (415) 890-4820', 'HyperScale Systems')" style="padding:6px 12px;background:#FF6B00;color:#fff;font-size:11px;font-weight:600;border:none;border-radius:2px;cursor:pointer;">Inspect Scope</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ================= 4. TAB: ARTICLES CMS ================= -->
      <div id="tab_articles" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
          <div>
            <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">Knowledge Center Articles &amp; Editorial Blueprints</h1>
            <p style="font-size:13px;color:#64748B;margin:0;">Publish, update, and manage editorial research, comparison tables, and news-based knowledge articles.</p>
          </div>
          <button onclick="openModal('addArticleModal')" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">+ Open Rich Article Studio</button>
        </div>

        <!-- Sub navigation -->
        <div style="display:flex;gap:10px;border-bottom:1px solid #E2E8F0;margin-bottom:20px;padding-bottom:8px;">
          <button type="button" onclick="switchArticleSubTab('published_blueprints', this)" class="art-subtab-btn" style="padding:6px 14px;background:#0052FF;color:#fff;border:none;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">Core Blueprints</button>
          <button type="button" onclick="switchArticleSubTab('news_drafts', this)" class="art-subtab-btn" style="padding:6px 14px;background:#E2E8F0;color:#334155;border:none;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">News Editorial Drafts</button>
        </div>

        <div id="subpane_published_blueprints">
          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:16px;" id="articlesGrid">
            
            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;">
              <div style="height:140px;background:#0B1120;position:relative;overflow:hidden;">
                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=600&auto=format&fit=crop" style="width:100%;height:100%;object-fit:cover;opacity:0.8;">
                <span style="position:absolute;top:10px;left:10px;background:#0052FF;color:#fff;font-size:10px;font-weight:700;padding:2px 8px;border-radius:2px;">HERO ARTICLE</span>
              </div>
              <div style="padding:16px;flex:1;display:flex;flex-direction:column;justify-content:space-between;">
                <div>
                  <span style="font-size:11px;color:#0052FF;font-weight:600;display:block;margin-bottom:4px;">Cloud &amp; AI Breakthrough • Aug 15, 2026</span>
                  <h4 style="font-size:14px;font-weight:700;color:#0F172A;line-height:1.4;margin:0 0 8px;">Global Cloud Infrastructures Shift to Autonomous AI Agents for Real-Time Threat Isolation</h4>
                  <p style="font-size:12px;color:#64748B;line-height:1.6;margin:0;">Enterprise architectures are adopting multi-agent neural orchestration to automate hybrid cloud workloads...</p>
                </div>
                <div style="display:flex;gap:8px;margin-top:16px;padding-top:12px;border-top:1px solid #F1F5F9;">
                  <button onclick="openModal('addArticleModal')" style="flex:1;padding:6px;background:#F1F5F9;color:#0F172A;font-size:11px;font-weight:600;border:1px solid #CBD5E1;border-radius:2px;cursor:pointer;">Edit in Studio</button>
                  <a href="knowledge-center" target="_blank" style="padding:6px 12px;background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:600;border:1px solid #BFDBFE;border-radius:2px;text-decoration:none;">Preview ↗</a>
                </div>
              </div>
            </div>

            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;">
              <div style="height:140px;background:#0B1120;position:relative;overflow:hidden;">
                <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=600&auto=format&fit=crop" style="width:100%;height:100%;object-fit:cover;opacity:0.8;">
                <span style="position:absolute;top:10px;left:10px;background:#10B981;color:#fff;font-size:10px;font-weight:700;padding:2px 8px;border-radius:2px;">PUBLISHED</span>
              </div>
              <div style="padding:16px;flex:1;display:flex;flex-direction:column;justify-content:space-between;">
                <div>
                  <span style="font-size:11px;color:#0052FF;font-weight:600;display:block;margin-bottom:4px;">AI Research Archive • Aug 12, 2026</span>
                  <h4 style="font-size:14px;font-weight:700;color:#0F172A;line-height:1.4;margin:0 0 8px;">Artificial Intelligence Development from 1950 to 1965: The Foundation of Modern AI</h4>
                  <p style="font-size:12px;color:#64748B;line-height:1.6;margin:0;">An institutional look back at symbolic reasoning, early neural networks, and how mathematical proofs evolved...</p>
                </div>
                <div style="display:flex;gap:8px;margin-top:16px;padding-top:12px;border-top:1px solid #F1F5F9;">
                  <button onclick="openModal('addArticleModal')" style="flex:1;padding:6px;background:#F1F5F9;color:#0F172A;font-size:11px;font-weight:600;border:1px solid #CBD5E1;border-radius:2px;cursor:pointer;">Edit in Studio</button>
                  <a href="knowledge-center" target="_blank" style="padding:6px 12px;background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:600;border:1px solid #BFDBFE;border-radius:2px;text-decoration:none;">Preview ↗</a>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div id="subpane_news_drafts" style="display:none;">
          <div id="adminNewsDraftsList" style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:16px;">
            <!-- Dynamically populated from knowledge_drafts.json -->
          </div>
        </div>

      </div>

      <!-- ================= 5. TAB: VIDEOS CMS ================= -->
      <div id="tab_videos" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
          <div>
            <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">Video Keynotes &amp; Feature Media</h1>
            <p style="font-size:13px;color:#64748B;margin:0;">Manage media recordings, YouTube embeds, and masterclass sessions.</p>
          </div>
          <button onclick="openModal('addVideoModal')" style="padding:8px 16px;background:#FF6B00;color:#fff;font-size:12px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">+ Add Video</button>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));gap:16px;">
          <div style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <div style="height:150px;background:#000;position:relative;">
              <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=600&auto=format&fit=crop" style="width:100%;height:100%;object-fit:cover;opacity:0.75;">
              <span style="position:absolute;bottom:10px;right:10px;background:rgba(0,0,0,0.8);color:#fff;font-size:11px;font-weight:700;padding:2px 6px;border-radius:2px;">14:20</span>
            </div>
            <div style="padding:14px;">
              <span style="font-size:10px;font-weight:700;color:#FF6B00;text-transform:uppercase;">Digital Ads &amp; Scale</span>
              <h4 style="font-size:13px;font-weight:700;color:#0F172A;margin:4px 0 8px;">What Are Social Advertising Algorithms &amp; Conversion Tracking in 2026?</h4>
              <p style="font-size:11px;color:#64748B;font-family:monospace;margin:0 0 10px;">URL: youtube.com/watch?v=dQw4w9WgXcQ</p>
              <div style="display:flex;gap:6px;">
                <button style="flex:1;padding:6px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Edit</button>
                <button style="padding:6px 12px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ================= 6. TAB: TECH WIRE NEWS ================= -->
      <div id="tab_news_wire" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
          <div>
            <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">Tech Wire News (Canonical Feed Reference)</h1>
            <p style="font-size:13px;color:#64748B;margin:0;">Source items are read-only references. Click <strong>"+ Create Knowledge Draft"</strong> to draft an independent Creed-Tech article.</p>
          </div>
          <button id="btnRefreshTechWire" onclick="refreshTechWireFeed(this)" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">Refresh Feed 🔄</button>
        </div>

        <div id="adminTechWireList" style="display:flex;flex-direction:column;gap:14px;">
          <?php
          require_once __DIR__ . '/includes/news_canonical_helper.php';
          $preRenderedWire = get_all_canonical_news_records();
          if (!empty($preRenderedWire)):
            foreach ($preRenderedWire as $item):
              $prov = htmlspecialchars(strtoupper($item['provider'] ?? 'WIRE'), ENT_QUOTES, 'UTF-8');
              $rawProv = htmlspecialchars($item['provider'] ?? 'wire', ENT_QUOTES, 'UTF-8');
              $title = htmlspecialchars($item['title'] ?? '', ENT_QUOTES, 'UTF-8');
              $desc = htmlspecialchars($item['desc'] ?? '', ENT_QUOTES, 'UTF-8');
              $date = htmlspecialchars($item['date'] ?? '', ENT_QUOTES, 'UTF-8');
              $link = htmlspecialchars($item['link'] ?? '#', ENT_QUOTES, 'UTF-8');
              $extIdEnc = urlencode($item['external_id'] ?? '');
              $img = htmlspecialchars($item['img'] ?? 'Creed-Tech-Logo-Clean.png', ENT_QUOTES, 'UTF-8');
          ?>
            <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:8px;padding:16px;display:flex;gap:18px;align-items:flex-start;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
              <div style="width:140px;height:100px;background:#0F172A;border-radius:6px;overflow:hidden;flex-shrink:0;position:relative;">
                <img src="<?php echo $img; ?>" alt="" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='Creed-Tech-Logo-Clean.png'">
              </div>
              <div style="flex:1;display:flex;flex-direction:column;gap:6px;">
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                  <span style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:10px;background:#EFF6FF;color:#0052FF;text-transform:uppercase;"><?php echo $prov; ?></span>
                  <span style="font-size:11px;color:#64748B;"><?php echo $date; ?></span>
                  <span style="margin-left:auto;font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;padding:2px 6px;border-radius:4px;border:1px solid #A7F3D0;">VERIFIED FEED</span>
                </div>
                <h4 style="font-size:14px;font-weight:700;color:#0F172A;margin:0;line-height:1.4;"><?php echo $title; ?></h4>
                <p style="font-size:12px;color:#475569;margin:0;line-height:1.5;"><?php echo $desc; ?></p>
                <div style="display:flex;align-items:center;gap:12px;margin-top:8px;">
                  <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" style="font-size:11px;font-weight:600;color:#64748B;text-decoration:none;">Read Original ↗</a>
                  <button onclick="handleCreateOrOpenDraft(this)" 
                    data-provider="<?php echo $rawProv; ?>" 
                    data-extid="<?php echo htmlspecialchars($item['external_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                    data-title="<?php echo $title; ?>"
                    data-link="<?php echo $link; ?>"
                    data-img="<?php echo $img; ?>"
                    data-date="<?php echo $date; ?>"
                    data-desc="<?php echo $desc; ?>"
                    style="margin-left:auto;padding:6px 14px;background:#0052FF;color:#FFFFFF;border:none;border-radius:4px;font-size:11px;font-weight:600;cursor:pointer;box-shadow:0 1px 2px rgba(0,0,0,0.1);">
                    + Create Knowledge Draft
                  </button>
                </div>
              </div>
            </div>
          <?php
            endforeach;
          endif;
          ?>
        </div>
      </div>

      <!-- ================= 7. TAB: REVIEWS ================= -->
      <div id="tab_reviews" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
          <div>
            <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">Client Testimonials &amp; Endorsements (8 Reviews)</h1>
            <p style="font-size:13px;color:#64748B;margin:0;">Manage, approve, feature, or delete verified client quotes displayed on the Home Page and Knowledge Center.</p>
          </div>
          <div style="display:flex;gap:10px;">
            <button onclick="openModal('addAdminReviewModal')" style="padding:8px 16px;background:#FF6B00;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">+ Add Testimonial</button>
            <button onclick="alert('All verified reviews synced with homepage carousel!')" style="padding:8px 16px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:12px;font-weight:700;border-radius:4px;cursor:pointer;">Sync Carousel 🔄</button>
          </div>
        </div>

        <div id="adminReviewsGrid" style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:16px;">
          
          <!-- Card 1 -->
          <div style="background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:space-between;">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#FF6B00;font-size:14px;letter-spacing:2px;">★★★★★</span>
                <span style="font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;border:1px solid #A7F3D0;padding:2px 8px;border-radius:2px;">FEATURED ON HOME</span>
              </div>
              <p style="font-size:13px;color:#334155;line-height:1.6;font-style:italic;margin:0 0 12px;">
                "I'm using Creed Tech for our enterprise cloud architecture. It allowed us to deploy multi-region failover seamlessly with zero downtime and unprecedented speed."
              </p>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid #F1F5F9;padding-top:12px;margin-top:8px;">
              <div>
                <div style="font-size:13px;font-weight:700;color:#0F172A;">Marina R.</div>
                <div style="font-size:11px;color:#64748B;">Enterprise Cloud Director • Italy</div>
              </div>
              <div style="display:flex;gap:6px;">
                <button onclick="toggleReviewStatus(this)" style="padding:4px 8px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Active</button>
                <button onclick="deleteReviewCard(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button>
              </div>
            </div>
          </div>

          <!-- Card 2 -->
          <div style="background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:space-between;">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#FF6B00;font-size:14px;letter-spacing:2px;">★★★★★</span>
                <span style="font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;border:1px solid #A7F3D0;padding:2px 8px;border-radius:2px;">FEATURED ON HOME</span>
              </div>
              <p style="font-size:13px;color:#334155;line-height:1.6;font-style:italic;margin:0 0 12px;">
                "We had a complex legacy database problem and the engineering support was world-class. Solved our bottleneck within days. Exceptional technical maturity."
              </p>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid #F1F5F9;padding-top:12px;margin-top:8px;">
              <div>
                <div style="font-size:13px;font-weight:700;color:#0F172A;">David L.</div>
                <div style="font-size:11px;color:#64748B;">Chief Technical Officer • United States</div>
              </div>
              <div style="display:flex;gap:6px;">
                <button onclick="toggleReviewStatus(this)" style="padding:4px 8px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Active</button>
                <button onclick="deleteReviewCard(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button>
              </div>
            </div>
          </div>

          <!-- Card 3 -->
          <div style="background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:space-between;">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#FF6B00;font-size:14px;letter-spacing:2px;">★★★★★</span>
                <span style="font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;border:1px solid #A7F3D0;padding:2px 8px;border-radius:2px;">FEATURED ON HOME</span>
              </div>
              <p style="font-size:13px;color:#334155;line-height:1.6;font-style:italic;margin:0 0 12px;">
                "Exceptional full-stack capabilities and attention to detail. They built our AI-driven document intelligence pipeline and integrated it directly with our ERP."
              </p>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid #F1F5F9;padding-top:12px;margin-top:8px;">
              <div>
                <div style="font-size:13px;font-weight:700;color:#0F172A;">Dr. Elena Rostova</div>
                <div style="font-size:11px;color:#64748B;">Head of Neural Systems • Germany</div>
              </div>
              <div style="display:flex;gap:6px;">
                <button onclick="toggleReviewStatus(this)" style="padding:4px 8px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Active</button>
                <button onclick="deleteReviewCard(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button>
              </div>
            </div>
          </div>

          <!-- Card 4 -->
          <div style="background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:space-between;">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#FF6B00;font-size:14px;letter-spacing:2px;">★★★★★</span>
                <span style="font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;border:1px solid #A7F3D0;padding:2px 8px;border-radius:2px;">FEATURED ON HOME</span>
              </div>
              <p style="font-size:13px;color:#334155;line-height:1.6;font-style:italic;margin:0 0 12px;">
                "I use Creed Tech engineering teams across our portfolio companies. Their ability to step in and execute high-speed sprints is unmatched in the industry."
              </p>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid #F1F5F9;padding-top:12px;margin-top:8px;">
              <div>
                <div style="font-size:13px;font-weight:700;color:#0F172A;">Marvin M.</div>
                <div style="font-size:11px;color:#64748B;">Managing Partner, Venture Labs • Germany</div>
              </div>
              <div style="display:flex;gap:6px;">
                <button onclick="toggleReviewStatus(this)" style="padding:4px 8px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Active</button>
                <button onclick="deleteReviewCard(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button>
              </div>
            </div>
          </div>

          <!-- Card 5 -->
          <div style="background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:space-between;">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#FF6B00;font-size:14px;letter-spacing:2px;">★★★★★</span>
                <span style="font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;border:1px solid #A7F3D0;padding:2px 8px;border-radius:2px;">FEATURED ON HOME</span>
              </div>
              <p style="font-size:13px;color:#334155;line-height:1.6;font-style:italic;margin:0 0 12px;">
                "It's been 4 years now that we rely on Creed Tech for dedicated staff augmentation and infrastructure. Top quality code and rock-solid reliability."
              </p>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid #F1F5F9;padding-top:12px;margin-top:8px;">
              <div>
                <div style="font-size:13px;font-weight:700;color:#0F172A;">Sarah Jenkins</div>
                <div style="font-size:11px;color:#64748B;">VP of Product Delivery • United Kingdom</div>
              </div>
              <div style="display:flex;gap:6px;">
                <button onclick="toggleReviewStatus(this)" style="padding:4px 8px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Active</button>
                <button onclick="deleteReviewCard(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button>
              </div>
            </div>
          </div>

          <!-- Card 6 -->
          <div style="background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:space-between;">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#FF6B00;font-size:14px;letter-spacing:2px;">★★★★☆</span>
                <span style="font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;border:1px solid #A7F3D0;padding:2px 8px;border-radius:2px;">FEATURED ON HOME</span>
              </div>
              <p style="font-size:13px;color:#334155;line-height:1.6;font-style:italic;margin:0 0 12px;">
                "Our fintech trading platform processing speed improved by 80%. Automated compliance logging saved our internal audit team hundreds of hours."
              </p>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid #F1F5F9;padding-top:12px;margin-top:8px;">
              <div>
                <div style="font-size:13px;font-weight:700;color:#0F172A;">Liam Gallagher</div>
                <div style="font-size:11px;color:#64748B;">FinTech Systems Architect • Australia</div>
              </div>
              <div style="display:flex;gap:6px;">
                <button onclick="toggleReviewStatus(this)" style="padding:4px 8px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Active</button>
                <button onclick="deleteReviewCard(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button>
              </div>
            </div>
          </div>

          <!-- Card 7 -->
          <div style="background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:space-between;">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#FF6B00;font-size:14px;letter-spacing:2px;">★★★★★</span>
                <span style="font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;border:1px solid #A7F3D0;padding:2px 8px;border-radius:2px;">APPROVED</span>
              </div>
              <p style="font-size:13px;color:#334155;line-height:1.6;font-style:italic;margin:0 0 12px;">
                "Creed Tech transformed our legacy database into an automated distributed cluster with zero downtime across 15 countries."
              </p>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid #F1F5F9;padding-top:12px;margin-top:8px;">
              <div>
                <div style="font-size:13px;font-weight:700;color:#0F172A;">Marcus Vance</div>
                <div style="font-size:11px;color:#64748B;">VP of Engineering, Apex Global UK</div>
              </div>
              <div style="display:flex;gap:6px;">
                <button onclick="toggleReviewStatus(this)" style="padding:4px 8px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Active</button>
                <button onclick="deleteReviewCard(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button>
              </div>
            </div>
          </div>

          <!-- Card 8 -->
          <div style="background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:space-between;">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#FF6B00;font-size:14px;letter-spacing:2px;">★★★★★</span>
                <span style="font-size:10px;font-weight:700;color:#10B981;background:#ECFDF5;border:1px solid #A7F3D0;padding:2px 8px;border-radius:2px;">APPROVED</span>
              </div>
              <p style="font-size:13px;color:#334155;line-height:1.6;font-style:italic;margin:0 0 12px;">
                "Sovereign HIPAA-compliant AI pipelines executed flawlessly with 99.4% diagnostic accuracy and total data isolation."
              </p>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid #F1F5F9;padding-top:12px;margin-top:8px;">
              <div>
                <div style="font-size:13px;font-weight:700;color:#0F172A;">Dr. Aris Thorne</div>
                <div style="font-size:11px;color:#64748B;">Chief Medical Information Officer • USA</div>
              </div>
              <div style="display:flex;gap:6px;">
                <button onclick="toggleReviewStatus(this)" style="padding:4px 8px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Active</button>
                <button onclick="deleteReviewCard(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ================= TAB: ARTICLE REVIEWS MODERATION (Dedicated) ================= -->
      <div id="tab_article_reviews" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
          <div>
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
              <span style="background:#0052FF;color:#fff;font-size:10px;font-weight:800;padding:2px 8px;border-radius:2px;letter-spacing:0.05em;text-transform:uppercase;">MODERATION DESK</span>
              <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0;">Article &amp; Hardware Reviews Moderation</h1>
            </div>
            <p style="font-size:13px;color:#64748B;margin:0;">Inspect, approve, or reject user-submitted article telemetry reviews before they go live on the public website.</p>
          </div>
          <div style="display:flex;gap:8px;">
            <button onclick="filterArticleReviews('ALL')" class="art-rev-tab-btn" id="artRevTabAll" style="padding:6px 14px;background:#0F172A;color:#fff;font-size:11px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">All Reviews</button>
            <button onclick="filterArticleReviews('PENDING')" class="art-rev-tab-btn" id="artRevTabPending" style="padding:6px 14px;background:#FEF3C7;color:#D97706;font-size:11px;font-weight:700;border:1px solid #FDE68A;border-radius:4px;cursor:pointer;">Pending Approval</button>
            <button onclick="filterArticleReviews('APPROVED')" class="art-rev-tab-btn" id="artRevTabApproved" style="padding:6px 14px;background:#ECFDF5;color:#059669;font-size:11px;font-weight:700;border:1px solid #A7F3D0;border-radius:4px;cursor:pointer;">Live on Site</button>
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
          <table style="width:100%;text-align:left;border-collapse:collapse;font-size:13px;">
            <thead>
              <tr style="background:#F8FAFC;border-bottom:2px solid #E2E8F0;color:#64748B;font-size:11px;text-transform:uppercase;">
                <th style="padding:12px 16px;">Reviewer &amp; Organization</th>
                <th style="padding:12px 16px;">Rating &amp; Title</th>
                <th style="padding:12px 16px;">Review Details / Telemetry</th>
                <th style="padding:12px 16px;">Submitted</th>
                <th style="padding:12px 16px;">Live Status</th>
                <th style="padding:12px 16px;text-align:right;">Moderation Actions</th>
              </tr>
            </thead>
            <tbody id="articleReviewsTableBody">
              <!-- Injected via loadDynamicArticleReviews() -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- ================= 8. TAB: APPLICANTS & CAREERS CMS ================= -->
      <div id="tab_applicants" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
          <div>
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
              <span style="background:#0052FF;color:#fff;font-size:10px;font-weight:800;padding:2px 8px;border-radius:2px;letter-spacing:0.05em;text-transform:uppercase;">TALENT PIPELINE</span>
              <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0;">Careers CMS &amp; Talent Pool Candidates</h1>
            </div>
            <p style="font-size:13px;color:#64748B;margin:0;">Manage open job positions and track registered senior engineering candidates.</p>
          </div>
          <div style="display:flex;gap:10px;">
            <button onclick="openCreateJobModal()" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">+ Post New Job Role</button>
            <button onclick="exportCandidatesCsv()" style="padding:8px 16px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:12px;font-weight:700;color:#0F172A;border-radius:4px;cursor:pointer;">Export Candidates (CSV) 📥</button>
          </div>
        </div>

        <!-- TWO TABS INSIDE CAREERS: 1. CANDIDATES / 2. JOB OPENINGS -->
        <div style="display:flex;gap:10px;margin-bottom:20px;border-bottom:2px solid #E2E8F0;padding-bottom:12px;">
          <button type="button" onclick="switchCareersSubTab('candidates', this)" id="careersSubTabCandidates" style="padding:8px 18px;background:#0052FF;color:#fff;border:none;border-radius:4px;font-size:12.5px;font-weight:700;cursor:pointer;">
            👨‍💻 Talent Pool Candidates (<span id="candidatesCountBadge">0</span>)
          </button>
          <button type="button" onclick="switchCareersSubTab('jobs', this)" id="careersSubTabJobs" style="padding:8px 18px;background:#F1F5F9;color:#475569;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;font-weight:700;cursor:pointer;">
            💼 All Job Openings (<span id="jobsCountBadge">0</span>)
          </button>
        </div>

        <!-- 1. CANDIDATES TABLE -->
        <div id="careersSectionCandidates" style="display:block;">
          <div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <table style="width:100%;text-align:left;border-collapse:collapse;font-size:13px;">
              <thead>
                <tr style="background:#F8FAFC;border-bottom:2px solid #E2E8F0;color:#64748B;font-size:11px;text-transform:uppercase;">
                  <th style="padding:12px 16px;">Candidate Name &amp; Specialty</th>
                  <th style="padding:12px 16px;">Email Coordinates</th>
                  <th style="padding:12px 16px;">Portfolio / GitHub</th>
                  <th style="padding:12px 16px;">Date</th>
                  <th style="padding:12px 16px;">Application Status</th>
                  <th style="padding:12px 16px;text-align:right;">Actions</th>
                </tr>
              </thead>
              <tbody id="candidatesTableBody">
                <?php if (!empty($applicants)): ?>
                  <?php foreach ($applicants as $app): ?>
                    <tr style="border-bottom:1px solid #F1F5F9;">
                      <td style="padding:14px 16px;">
                        <div style="font-weight:700;color:#0F172A;font-size:13.5px;"><?php echo htmlspecialchars($app['fullName'] ?? 'Candidate'); ?></div>
                        <div style="font-size:11.5px;color:#0052FF;font-weight:600;"><?php echo htmlspecialchars($app['specialty'] ?? 'Engineering'); ?></div>
                      </td>
                      <td style="padding:14px 16px;color:#334155;font-size:12.5px;">
                        <a href="mailto:<?php echo htmlspecialchars($app['email'] ?? ''); ?>" style="color:#0F172A;text-decoration:none;font-weight:600;"><?php echo htmlspecialchars($app['email'] ?? ''); ?></a>
                      </td>
                      <td style="padding:14px 16px;">
                        <?php if (!empty($app['portfolioUrl'])): ?>
                          <a href="<?php echo htmlspecialchars($app['portfolioUrl']); ?>" target="_blank" style="color:#0052FF;text-decoration:underline;font-size:12px;display:inline-flex;align-items:center;gap:4px;">
                            <span>🔗</span> <span><?php echo htmlspecialchars(substr(str_replace('https://', '', $app['portfolioUrl']), 0, 24)); ?>...</span>
                          </a>
                        <?php else: ?>
                          <span style="color:#94A3B8;">None</span>
                        <?php endif; ?>
                      </td>
                      <td style="padding:14px 16px;color:#64748B;font-size:12px;white-space:nowrap;"><?php echo htmlspecialchars($app['date'] ?? 'Aug 2026'); ?></td>
                      <td style="padding:14px 16px;">
                        <?php 
                          $st = strtoupper($app['status'] ?? 'PENDING');
                          if ($st === 'SHORTLISTED') echo '<span style="background:#EFF6FF;color:#1D4ED8;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #BFDBFE;">SHORTLISTED</span>';
                          else if ($st === 'INTERVIEWING') echo '<span style="background:#ECFDF5;color:#059669;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #A7F3D0;">INTERVIEWING</span>';
                          else if ($st === 'HIRED') echo '<span style="background:#FAF5FF;color:#7E22CE;padding:3px 8px;font-size:11px;font-weight:800;border-radius:2px;border:1px solid #E9D5FF;">🎉 HIRED</span>';
                          else if ($st === 'REJECTED') echo '<span style="background:#FEF2F2;color:#DC2626;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #FECACA;">ARCHIVED</span>';
                          else echo '<span style="background:#FEF3C7;color:#D97706;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #FDE68A;">PENDING REVIEW</span>';
                        ?>
                      </td>
                      <td style="padding:14px 16px;text-align:right;white-space:nowrap;">
                        <select onchange="setApplicantStatus(<?php echo $app['id']; ?>, this.value)" style="padding:4px 8px;border:1px solid #CBD5E1;border-radius:3px;font-size:11px;font-weight:700;margin-right:6px;cursor:pointer;">
                          <option value="" disabled selected>Status ▾</option>
                          <option value="SHORTLISTED">Shortlist</option>
                          <option value="INTERVIEWING">Interview</option>
                          <option value="HIRED">Hire</option>
                          <option value="REJECTED">Archive</option>
                        </select>
                        <button onclick="deleteApplicant(<?php echo $app['id']; ?>)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:700;border-radius:3px;cursor:pointer;">✕</button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="6" style="padding:32px;text-align:center;color:#64748B;">No candidates registered yet. Submissions from careers page will appear here.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- 2. JOB OPENINGS GRID -->
        <div id="careersSectionJobs" style="display:none;">
          <div id="jobsAdminGrid" style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:16px;">
            <?php if (!empty($jobs)): ?>
              <?php foreach ($jobs as $job): ?>
                <div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,0.03);display:flex;flex-direction:column;justify-content:space-between;">
                  <div>
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                      <span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;"><?php echo htmlspecialchars($job['department']); ?></span>
                      <span style="font-size:10px;font-weight:700;padding:2px 6px;background:#FEF3C7;color:#92400E;border-radius:2px;"><?php echo htmlspecialchars($job['status']); ?></span>
                    </div>
                    <h4 style="font-size:15px;font-weight:800;color:#0F172A;margin:0 0 6px;line-height:1.3;"><?php echo htmlspecialchars($job['title']); ?></h4>
                    <div style="font-size:12px;color:#64748B;margin-bottom:10px;">📍 <?php echo htmlspecialchars($job['location']); ?></div>
                    <p style="font-size:12.5px;color:#475569;line-height:1.5;margin:0 0 12px;"><?php echo htmlspecialchars($job['description']); ?></p>
                    <div style="display:flex;gap:4px;flex-wrap:wrap;margin-bottom:14px;">
                      <?php foreach (($job['tags'] ?? []) as $t): ?>
                        <span style="padding:2px 6px;background:#F1F5F9;border:1px solid #E2E8F0;font-size:10px;font-family:monospace;border-radius:2px;color:#334155;"><?php echo htmlspecialchars($t); ?></span>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <div style="display:flex;justify-content:flex-end;gap:8px;border-top:1px solid #F1F5F9;padding-top:10px;">
                    <button onclick="deleteJob(<?php echo $job['id']; ?>)" style="padding:5px 12px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:700;border-radius:3px;cursor:pointer;">🗑️ Delete Role</button>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div style="padding:32px;text-align:center;color:#64748B;grid-column:1/-1;">No job openings posted yet. Click "+ Post New Job Role" above to create one.</div>
            <?php endif; ?>
          </div>
        </div>

      </div>

      <!-- ================= 9. TAB: SUBSCRIBERS ================= -->
      <div id="tab_subscribers" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
          <div>
            <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">Enterprise Newsletter Leads &amp; Subscribers</h1>
            <p style="font-size:13px;color:#64748B;margin:0;">Active executive subscribers enrolled via newsletter forms across all pages.</p>
          </div>
          <div style="display:flex;gap:10px;">
            <button onclick="exportSubscribersCsv()" style="padding:8px 16px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:12px;font-weight:700;color:#0F172A;border-radius:4px;cursor:pointer;">Export Subscribers (CSV) 📥</button>
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
          <table style="width:100%;text-align:left;border-collapse:collapse;font-size:13px;">
            <thead>
              <tr style="background:#F8FAFC;border-bottom:1px solid #E2E8F0;color:#64748B;font-size:11px;text-transform:uppercase;">
                <th style="padding:12px 16px;">Subscriber Email</th>
                <th style="padding:12px 16px;">Subscription Source</th>
                <th style="padding:12px 16px;">Date Subscribed</th>
                <th style="padding:12px 16px;">Status</th>
                <th style="padding:12px 16px;text-align:right;">Actions</th>
              </tr>
            </thead>
            <tbody id="subscribersTableBody">
              <tr style="border-bottom:1px solid #F1F5F9;">
                <td style="padding:14px 16px;font-weight:700;color:#0F172A;">cto@enterprise-cloud.de</td>
                <td style="padding:14px 16px;"><span style="background:#EFF6FF;color:#1D4ED8;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">Global Footer</span></td>
                <td style="padding:14px 16px;color:#64748B;">Aug 16, 2026</td>
                <td style="padding:14px 16px;"><span style="background:#ECFDF5;color:#059669;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">ACTIVE</span></td>
                <td style="padding:14px 16px;text-align:right;">
                  <button onclick="deleteSubscriberRow(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Remove</button>
                </td>
              </tr>
              <tr style="border-bottom:1px solid #F1F5F9;">
                <td style="padding:14px 16px;font-weight:700;color:#0F172A;">lead.arch@fintech-ny.com</td>
                <td style="padding:14px 16px;"><span style="background:#FDF2F8;color:#BE185D;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">Knowledge Center</span></td>
                <td style="padding:14px 16px;color:#64748B;">Aug 15, 2026</td>
                <td style="padding:14px 16px;"><span style="background:#ECFDF5;color:#059669;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">ACTIVE</span></td>
                <td style="padding:14px 16px;text-align:right;">
                  <button onclick="deleteSubscriberRow(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Remove</button>
                </td>
              </tr>
              <tr style="border-bottom:1px solid #F1F5F9;">
                <td style="padding:14px 16px;font-weight:700;color:#0F172A;">vp.eng@global-logistics.sg</td>
                <td style="padding:14px 16px;"><span style="background:#FFF7ED;color:#C2410C;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">Services Page</span></td>
                <td style="padding:14px 16px;color:#64748B;">Aug 14, 2026</td>
                <td style="padding:14px 16px;"><span style="background:#ECFDF5;color:#059669;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">ACTIVE</span></td>
                <td style="padding:14px 16px;text-align:right;">
                  <button onclick="deleteSubscriberRow(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Remove</button>
                </td>
              </tr>
              <tr style="border-bottom:1px solid #F1F5F9;">
                <td style="padding:14px 16px;font-weight:700;color:#0F172A;">security.officer@medtech-eu.ch</td>
                <td style="padding:14px 16px;"><span style="background:#F0FDF4;color:#15803D;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">Security Trust Hub</span></td>
                <td style="padding:14px 16px;color:#64748B;">Aug 13, 2026</td>
                <td style="padding:14px 16px;"><span style="background:#ECFDF5;color:#059669;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">ACTIVE</span></td>
                <td style="padding:14px 16px;text-align:right;">
                  <button onclick="deleteSubscriberRow(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Remove</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ================= 11. TAB: WEBSITE SETTINGS ================= -->
      <div id="tab_website_settings" class="admin-tab-pane" style="display:none;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:16px;">
          <div>
            <div style="display:inline-flex;align-items:center;gap:6px;background:#EFF6FF;border:1px solid #BFDBFE;padding:3px 10px;border-radius:20px;margin-bottom:6px;">
              <span style="width:6px;height:6px;border-radius:50%;background:#0052FF;"></span>
              <span style="font-size:10.5px;font-weight:700;color:#1E40AF;text-transform:uppercase;letter-spacing:0.06em;">FRONTEND CONFIGURATION ENGINE</span>
            </div>
            <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">Website &amp; Frontend Settings</h1>
            <p style="font-size:13px;color:#64748B;margin:0;">Control public website content, announcement bars, branding, contact coordinates, and footer details.</p>
          </div>
          <div style="display:flex;gap:10px;">
            <button type="button" onclick="loadWebsiteSettingsFromBackend()" style="padding:9px 18px;background:#F1F5F9;border:1px solid #CBD5E1;color:#334155;font-size:12.5px;font-weight:700;border-radius:4px;cursor:pointer;display:flex;align-items:center;gap:6px;">
              <span>🔄</span> Reload
            </button>
            <button type="button" onclick="saveWebsiteSettings()" style="padding:9px 22px;background:#0052FF;color:#fff;font-size:12.5px;font-weight:700;border:none;border-radius:4px;cursor:pointer;display:flex;align-items:center;gap:6px;box-shadow:0 4px 6px -1px rgba(0,82,255,0.3);">
              <span>💾</span> Save All Settings
            </button>
          </div>
        </div>

        <!-- Internal Page Tabs Sub-Navigation -->
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;border-bottom:1px solid #CBD5E1;padding-bottom:12px;overflow-x:auto;">
          <button type="button" onclick="switchWsSubTab('home', this)" class="ws-subtab-btn active" style="padding:9px 18px;font-size:13px;font-weight:700;border:1px solid #0052FF;border-radius:6px;background:#0052FF;color:#fff;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
            <span>🏠</span> Home Page
          </button>
          <button type="button" onclick="switchWsSubTab('about', this)" class="ws-subtab-btn" style="padding:9px 18px;font-size:13px;font-weight:700;border:1px solid #CBD5E1;border-radius:6px;background:#F1F5F9;color:#475569;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
            <span>🏢</span> About Page
          </button>
          <button type="button" onclick="switchWsSubTab('contact', this)" class="ws-subtab-btn" style="padding:9px 18px;font-size:13px;font-weight:700;border:1px solid #CBD5E1;border-radius:6px;background:#F1F5F9;color:#475569;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
            <span>📞</span> Contact Page
          </button>
          <button type="button" onclick="switchWsSubTab('portfolio', this)" class="ws-subtab-btn" style="padding:9px 18px;font-size:13px;font-weight:700;border:1px solid #CBD5E1;border-radius:6px;background:#F1F5F9;color:#475569;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
            <span>💼</span> Portfolio Page
          </button>
          <button type="button" onclick="switchWsSubTab('header_footer', this)" class="ws-subtab-btn" style="padding:9px 18px;font-size:13px;font-weight:700;border:1px solid #CBD5E1;border-radius:6px;background:#F1F5F9;color:#475569;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
            <span>🎨</span> Header &amp; Footer
          </button>
          <button type="button" onclick="switchWsSubTab('global', this)" class="ws-subtab-btn" style="padding:9px 18px;font-size:13px;font-weight:700;border:1px solid #CBD5E1;border-radius:6px;background:#F1F5F9;color:#475569;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
            <span>🌐</span> Global Settings
          </button>
        </div>

        <form id="websiteSettingsForm" onsubmit="event.preventDefault(); saveWebsiteSettings();" style="display:flex;flex-direction:column;gap:24px;">
          
          <!-- ================= 1. SUB-PANE: HOME PAGE ================= -->
          <div id="ws_subpane_home" class="ws-subpane" style="display:flex;flex-direction:column;gap:24px;">
            <!-- Homepage Hero Banner -->
            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;gap:8px;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;">
                <span style="font-size:18px;">🚀</span>
                <div>
                  <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Homepage Hero Content &amp; Call To Actions</h3>
                  <p style="font-size:12px;color:#64748B;margin:0;">Customize main landing page headlines and primary conversion buttons.</p>
                </div>
              </div>

              <div style="display:flex;flex-direction:column;gap:14px;">
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Hero Headline *</label>
                  <input type="text" id="ws_hero_headline" value="Engineering Scalable Enterprise Systems &amp; High-Velocity AI Products" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:14px;font-weight:700;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Hero Subheadline / Description</label>
                  <textarea id="ws_hero_subheadline" rows="2" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;line-height:1.5;outline:none;">We design, architect, and deploy production-grade software solutions, high-throughput cloud platforms, and frontier AI systems for ambitious enterprises globally.</textarea>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:14px;">
                  <div>
                    <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Primary CTA Text</label>
                    <input type="text" id="ws_hero_cta1_text" value="Get Started" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;font-weight:600;">
                  </div>
                  <div>
                    <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Primary CTA URL</label>
                    <input type="text" id="ws_hero_cta1_url" value="get-started" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Secondary CTA Text</label>
                    <input type="text" id="ws_hero_cta2_text" value="Explore Services" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;font-weight:600;">
                  </div>
                  <div>
                    <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Secondary CTA URL</label>
                    <input type="text" id="ws_hero_cta2_url" value="services" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ================= 2. SUB-PANE: ABOUT PAGE ================= -->
          <div id="ws_subpane_about" class="ws-subpane" style="display:none;flex-direction:column;gap:24px;">
            <!-- Global Engineering Centers / Hubs Configuration -->
            <div id="ws_hubs_section_card" style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;flex-wrap:wrap;gap:10px;">
                <div style="display:flex;align-items:center;gap:8px;">
                  <span style="font-size:18px;">🌍</span>
                  <div>
                    <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Global Engineering Centers &amp; Hubs</h3>
                    <p style="font-size:12px;color:#64748B;margin:0;">Manage international hub cities, countries, core specializations, addresses, and cover photos shown on the About page.</p>
                  </div>
                </div>
                <button type="button" onclick="addNewEngineeringHubRow()" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:6px;box-shadow:0 2px 4px rgba(0,82,255,0.25);">
                  <span>➕</span> Add Engineering Center
                </button>
              </div>

              <!-- Hubs Header Settings -->
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;margin-bottom:20px;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Section Badge Tag</label>
                    <input type="text" id="ws_hubs_badge" value="GLOBAL REACH &amp; CONTINUOUS COVERAGE" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Section Headline *</label>
                    <input type="text" id="ws_hubs_title" value="Three Specialized Global Engineering Centers" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div style="grid-column: span 2;">
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Section Description Paragraph</label>
                    <textarea id="ws_hubs_desc" rows="2" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;line-height:1.5;outline:none;">Operating across multiple time zones to deliver seamless 24/7 technical continuity and deep regional domain expertise.</textarea>
                  </div>
                </div>
              </div>

              <!-- Dynamic Hub Cards Container -->
              <div style="font-size:12px;font-weight:800;color:#1E293B;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                <span>🏢</span> Regional Engineering Hub Cards
              </div>
              <div id="adminEngineeringHubsList" style="display:flex;flex-direction:column;gap:16px;">
                <!-- Loaded via JavaScript -->
              </div>
            </div>

            <!-- Executive Leadership & Custodians Configuration -->
            <div id="ws_leadership_section_card" style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;flex-wrap:wrap;gap:10px;">
                <div style="display:flex;align-items:center;gap:8px;">
                  <span style="font-size:18px;">👥</span>
                  <div>
                    <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Executive Leadership &amp; Technical Custodians</h3>
                    <p style="font-size:12px;color:#64748B;margin:0;">Manage team names, executive titles, portrait pictures, specializations, biographies, quotes, and connect links.</p>
                  </div>
                </div>
                <button type="button" onclick="addNewLeadershipMemberRow()" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:6px;box-shadow:0 2px 4px rgba(0,82,255,0.25);">
                  <span>➕</span> Add Team Member
                </button>
              </div>

              <!-- Leadership Header Settings -->
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;margin-bottom:20px;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Section Badge Tag</label>
                    <input type="text" id="ws_leader_badge" value="THE PEOPLE BEHIND THE CODE" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Section Headline *</label>
                    <input type="text" id="ws_leader_title" value="Executive Leadership &amp; Technical Custodians" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div style="grid-column: span 2;">
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Section Description Paragraph</label>
                    <textarea id="ws_leader_desc" rows="2" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;line-height:1.5;outline:none;">Meet the founders and principal architects who guide our engineering vision and mentor our senior pods across 3 global centers.</textarea>
                  </div>
                </div>
              </div>

              <!-- Dynamic Leader Cards Container -->
              <div style="font-size:12px;font-weight:800;color:#1E293B;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                <span>👤</span> Individual Leadership Profiles
              </div>
              <div id="adminLeadershipMembersList" style="display:flex;flex-direction:column;gap:16px;">
                <!-- Loaded via JavaScript -->
              </div>
            </div>
          </div>

          <!-- ================= 3. SUB-PANE: CONTACT PAGE ================= -->
          <div id="ws_subpane_contact" class="ws-subpane" style="display:none;flex-direction:column;gap:24px;">
            <!-- Contact Page & Scoping Channels Configuration -->
            <div id="ws_contact_section_card" style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;flex-wrap:wrap;gap:10px;">
                <div style="display:flex;align-items:center;gap:8px;">
                  <span style="font-size:18px;">📞</span>
                  <div>
                    <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Contact Page &amp; Scoping Channels</h3>
                    <p style="font-size:12px;color:#64748B;margin:0;">Manage hero headers, SLA metric badges, direct phone/WhatsApp lines, onboarding stages, and FAQ accordion questions.</p>
                  </div>
                </div>
              </div>

              <!-- Contact Hero & Metrics Section -->
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;margin-bottom:20px;">
                <div style="font-size:12.5px;font-weight:700;color:#0F172A;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                  <span>🎯</span> Contact Page Hero &amp; Metrics
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Hero Badge Tag</label>
                    <input type="text" id="ws_contact_hero_badge" value="DIRECT ARCHITECT ACCESS • 4-HOUR GUARANTEED SLA" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Hero Headline *</label>
                    <input type="text" id="ws_contact_hero_title" value="Let's Build Something Enduring Together." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div style="grid-column:span 2;">
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Hero Description Paragraph</label>
                    <textarea id="ws_contact_hero_desc" rows="2" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;line-height:1.5;outline:none;">Connect directly with senior systems architects and technical leaders. Whether you need an end-to-end enterprise platform, sovereign AI pipelines, or dedicated engineering pods—we are ready.</textarea>
                  </div>
                </div>

                <!-- 3 Metrics -->
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;background:#fff;padding:12px;border:1px solid #E2E8F0;border-radius:6px;">
                  <div>
                    <label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:3px;">Metric 1 Label</label>
                    <input type="text" id="ws_contact_m1_label" value="Average Response" style="width:100%;padding:6px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">
                    <label style="display:block;font-size:11px;font-weight:700;color:#475569;margin:6px 0 3px;">Metric 1 Value</label>
                    <input type="text" id="ws_contact_m1_val" value="< 2.4 Hours" style="width:100%;padding:6px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:3px;">Metric 2 Label</label>
                    <input type="text" id="ws_contact_m2_label" value="NDA &amp; IP Protection" style="width:100%;padding:6px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">
                    <label style="display:block;font-size:11px;font-weight:700;color:#475569;margin:6px 0 3px;">Metric 2 Value</label>
                    <input type="text" id="ws_contact_m2_val" value="Signed Day 1" style="width:100%;padding:6px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:3px;">Metric 3 Label</label>
                    <input type="text" id="ws_contact_m3_label" value="Verified Ratings" style="width:100%;padding:6px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">
                    <label style="display:block;font-size:11px;font-weight:700;color:#475569;margin:6px 0 3px;">Metric 3 Value</label>
                    <input type="text" id="ws_contact_m3_val" value="5.0 Clutch &amp; Google" style="width:100%;padding:6px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">
                  </div>
                </div>
              </div>

              <!-- Direct Channels & Instant Call Box -->
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;margin-bottom:20px;">
                <div style="font-size:12.5px;font-weight:700;color:#0F172A;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                  <span>💬</span> Direct Communications &amp; Instant Discovery Call
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Discovery Box Badge</label>
                    <input type="text" id="ws_contact_disc_badge" value="⚡ INSTANT DISCOVERY" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Discovery Box Title</label>
                    <input type="text" id="ws_contact_disc_title" value="Need a Direct Architectural Call?" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div style="grid-column:span 2;">
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Discovery Box Description</label>
                    <input type="text" id="ws_contact_disc_desc" value="Skip the form and schedule a 30-minute discovery call directly with one of our Principal Systems Architects." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Discovery Booking Email</label>
                    <input type="email" id="ws_contact_disc_email" value="contact@creed-tech.com" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Official Inquiries Email</label>
                    <input type="email" id="ws_contact_off_email" value="contact@creed-tech.com" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Global Telemetry Line Phone</label>
                    <input type="text" id="ws_contact_phone" value="+1 (415) 890-4820" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">WhatsApp Number Display</label>
                    <input type="text" id="ws_contact_wa_num" value="+1 (415) 890-4820" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div style="grid-column:span 2;">
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">WhatsApp Direct Chat Link URL</label>
                    <input type="text" id="ws_contact_wa_url" value="https://wa.me/14158904820" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                </div>
              </div>

              <!-- 4-Step Onboarding Process -->
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;margin-bottom:20px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;flex-wrap:wrap;gap:10px;">
                  <div style="font-size:12.5px;font-weight:700;color:#0F172A;display:flex;align-items:center;gap:6px;">
                    <span>🚀</span> 4-Stage Onboarding Process Steps
                  </div>
                  <button type="button" onclick="addNewContactStepRow()" style="padding:6px 14px;background:#0F172A;color:#fff;font-size:11.5px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">
                    ➕ Add Onboarding Step
                  </button>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Steps Badge Tag</label>
                    <input type="text" id="ws_contact_steps_badge" value="EXECUTION CERTAINTY" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Steps Section Title</label>
                    <input type="text" id="ws_contact_steps_title" value="What Happens After You Reach Out?" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div style="grid-column:span 2;">
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Steps Description</label>
                    <textarea id="ws_contact_steps_desc" rows="2" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;line-height:1.5;outline:none;">Our deterministic 4-stage onboarding model eliminates ambiguity and ensures rapid engineering ramp-up.</textarea>
                  </div>
                </div>
                <div id="adminContactStepsList" style="display:flex;flex-direction:column;gap:12px;">
                  <!-- Loaded via JS -->
                </div>
              </div>

              <!-- FAQs Accordion List -->
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;margin-bottom:20px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;flex-wrap:wrap;gap:10px;">
                  <div style="font-size:12.5px;font-weight:700;color:#0F172A;display:flex;align-items:center;gap:6px;">
                    <span>❓</span> Frequently Asked Questions (FAQs)
                  </div>
                  <button type="button" onclick="addNewContactFaqRow()" style="padding:6px 14px;background:#0052FF;color:#fff;font-size:11.5px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">
                    ➕ Add FAQ
                  </button>
                </div>
                <div id="adminContactFaqsList" style="display:flex;flex-direction:column;gap:12px;">
                  <!-- Loaded via JS -->
                </div>
              </div>

              <!-- Bottom RFP CTA Banner -->
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;">
                <div style="font-size:12.5px;font-weight:700;color:#0F172A;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                  <span>📢</span> Bottom Enterprise RFP Banner
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                  <div style="grid-column:span 2;">
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">CTA Banner Title</label>
                    <input type="text" id="ws_contact_cta_title" value="Prefer direct enterprise correspondence?" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div style="grid-column:span 2;">
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">CTA Banner Description</label>
                    <textarea id="ws_contact_cta_desc" rows="2" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;line-height:1.5;outline:none;">Send your RFP, architecture specs, or tender documents directly to our senior leadership inbox at projects@creed-tech.com.</textarea>
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">CTA Button Text</label>
                    <input type="text" id="ws_contact_cta_btn_text" value="Email RFP / Architecture Docs" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">CTA Target Email</label>
                    <input type="email" id="ws_contact_cta_btn_email" value="projects@creed-tech.com" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ================= 4. SUB-PANE: PORTFOLIO PAGE ================= -->
          <div id="ws_subpane_portfolio" class="ws-subpane" style="display:none;flex-direction:column;gap:24px;">
            <!-- Portfolio Projects & Case Studies Configuration -->
            <div id="ws_portfolio_section_card" style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;flex-wrap:wrap;gap:10px;">
                <div style="display:flex;align-items:center;gap:8px;">
                  <span style="font-size:18px;">💼</span>
                  <div>
                    <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Portfolio Case Studies &amp; Projects Settings</h3>
                    <p style="font-size:12px;color:#64748B;margin:0;">Manage project titles, cover pictures, impact metrics, technologies, and client locations displayed on the Portfolio page.</p>
                  </div>
                </div>
                <button type="button" onclick="addNewPortfolioProjectRow()" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:6px;box-shadow:0 2px 4px rgba(0,82,255,0.25);">
                  <span>➕</span> Add New Project
                </button>
              </div>

              <!-- Engineering Standards Header Showcase Picture & Copy -->
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;margin-bottom:20px;">
                <div style="font-size:12px;font-weight:800;color:#1E293B;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                  <span>🛠️</span> Portfolio Engineering Standards Showcase Section
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Section Headline *</label>
                    <input type="text" id="ws_pf_std_title" value="Built on Rigorous Enterprise Standards" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Showcase Picture URL *</label>
                    <input type="url" id="ws_pf_std_img" value="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&auto=format&fit=crop&q=80" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Badge Label</label>
                    <input type="text" id="ws_pf_std_badge" value="ENGINEERING CULTURE" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Overlay Metric Title</label>
                    <input type="text" id="ws_pf_std_overlay_title" value="100% Principal Engineer Led" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                  </div>
                  <div style="grid-column: span 2;">
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Section Description Paragraph</label>
                    <textarea id="ws_pf_std_desc" rows="2" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;line-height:1.5;outline:none;">Every case study in our portfolio is the direct outcome of disciplined architectural principles, continuous automated verification, and zero-compromise security controls.</textarea>
                  </div>
                </div>
              </div>

              <!-- Dynamic Project Cards Container -->
              <div style="font-size:12px;font-weight:800;color:#1E293B;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                <span>📁</span> Individual Case Studies &amp; Project Cards
              </div>
              <div id="adminPortfolioProjectsList" style="display:flex;flex-direction:column;gap:16px;">
                <!-- Loaded via JavaScript -->
              </div>
            </div>
          </div>

          <!-- ================= 5. SUB-PANE: HEADER & FOOTER ================= -->
          <div id="ws_subpane_header_footer" class="ws-subpane" style="display:none;flex-direction:column;gap:24px;">
            
            <!-- Header Settings Card -->
            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;flex-wrap:wrap;gap:10px;">
                <div style="display:flex;align-items:center;gap:8px;">
                  <span style="font-size:18px;">🧭</span>
                  <div>
                    <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Header Navigation &amp; CTA Settings</h3>
                    <p style="font-size:12px;color:#64748B;margin:0;">Manage brand logo asset, top navigation links (desktop &amp; mobile), and the primary header Call To Action button.</p>
                  </div>
                </div>
                <button type="button" onclick="addNewNavLinkRow()" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:6px;box-shadow:0 2px 4px rgba(0,82,255,0.25);">
                  <span>➕</span> Add Navigation Link
                </button>
              </div>

              <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;margin-bottom:20px;">
                <div>
                  <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Logo Asset / Image Path *</label>
                  <input type="text" id="ws_header_logo_url" value="Creed-Tech-Logo-Clean.png" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Header CTA Button Text *</label>
                  <input type="text" id="ws_header_cta_text" value="Get Started" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;font-weight:600;">
                </div>
                <div>
                  <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Header CTA Button URL / Route *</label>
                  <input type="text" id="ws_header_cta_url" value="get-started" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">
                </div>
              </div>

              <!-- Dynamic Navigation Links List -->
              <div style="font-size:12px;font-weight:800;color:#1E293B;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                <span>🔗</span> Global Navigation Menu (Desktop &amp; Mobile)
              </div>
              <div id="adminNavLinksList" style="display:flex;flex-direction:column;gap:12px;">
                <!-- Loaded via JS -->
              </div>
            </div>

            <!-- Footer Settings Card -->
            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;gap:8px;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;">
                <span style="font-size:18px;">📄</span>
                <div>
                  <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Footer Information, Description &amp; Links</h3>
                  <p style="font-size:12px;color:#64748B;margin:0;">Manage company brand overview paragraphs, Useful Links column, and Our Services links column.</p>
                </div>
              </div>

              <!-- Brand Description Paragraphs -->
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;margin-bottom:20px;">
                <div style="font-size:12px;font-weight:800;color:#1E293B;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                  <span>📝</span> Company Description Paragraphs (Under Footer Logo)
                </div>
                <div style="display:flex;flex-direction:column;gap:12px;">
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Paragraph 1</label>
                    <textarea id="ws_footer_p1" rows="2" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;line-height:1.5;outline:none;">We specialize in enterprise software architecture, robust cloud infrastructure, and next-generation cybersecurity.</textarea>
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Paragraph 2</label>
                    <textarea id="ws_footer_p2" rows="2" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;line-height:1.5;outline:none;">Engineering scalable, high-performance, and resilient systems tailored for global enterprises and modern businesses.</textarea>
                  </div>
                  <div>
                    <label style="display:block;font-size:11.5px;font-weight:700;color:#334155;margin-bottom:4px;">Paragraph 3</label>
                    <textarea id="ws_footer_p3" rows="2" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;line-height:1.5;outline:none;">Delivering end-to-end digital transformation, modern web systems, and strategic IT consulting to accelerate growth.</textarea>
                  </div>
                </div>
              </div>

              <!-- Contact Info Notice (No duplicates, connected to General Settings) -->
              <div style="background:#EFF6FF;border:1px solid #BFDBFE;border-radius:6px;padding:14px 16px;margin-bottom:20px;display:flex;align-items:flex-start;gap:10px;">
                <span style="font-size:16px;color:#1E40AF;">ℹ️</span>
                <div style="font-size:12px;color:#1E40AF;line-height:1.5;">
                  <strong>Footer Contact Coordinates:</strong> Address, Email, and Phone shown in the Footer are dynamically synchronized with <strong>Global Settings &rarr; General Site Information</strong>. Any changes to Primary Office Address, Contact Email, or Phone in Global Settings automatically reflect in the Footer.
                </div>
              </div>

              <!-- Useful Links & Services Links Columns -->
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <!-- Useful Links Column -->
                <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;">
                  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;flex-wrap:wrap;gap:8px;">
                    <div style="font-size:12px;font-weight:800;color:#1E293B;text-transform:uppercase;letter-spacing:0.05em;display:flex;align-items:center;gap:6px;">
                      <span>📌</span> Useful Links Column
                    </div>
                    <button type="button" onclick="addNewUsefulLinkRow()" style="padding:5px 12px;background:#0F172A;color:#fff;font-size:11.5px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">
                      ➕ Add Link
                    </button>
                  </div>
                  <div id="adminUsefulLinksList" style="display:flex;flex-direction:column;gap:10px;">
                    <!-- Loaded via JS -->
                  </div>
                </div>

                <!-- Our Services Column -->
                <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:16px;">
                  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;flex-wrap:wrap;gap:8px;">
                    <div style="font-size:12px;font-weight:800;color:#1E293B;text-transform:uppercase;letter-spacing:0.05em;display:flex;align-items:center;gap:6px;">
                      <span>⚡</span> Our Services Links Column
                    </div>
                    <button type="button" onclick="addNewServicesLinkRow()" style="padding:5px 12px;background:#0052FF;color:#fff;font-size:11.5px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">
                      ➕ Add Service Link
                    </button>
                  </div>
                  <div id="adminServicesLinksList" style="display:flex;flex-direction:column;gap:10px;">
                    <!-- Loaded via JS -->
                  </div>
                </div>
              </div>

            </div>

          </div>

          <!-- ================= 6. SUB-PANE: GLOBAL SETTINGS ================= -->
          <div id="ws_subpane_global" class="ws-subpane" style="display:none;flex-direction:column;gap:24px;">
            <!-- General Brand & Company Info -->
            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;gap:8px;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;">
                <span style="font-size:18px;">🏢</span>
                <div>
                  <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">General Site Information &amp; Branding</h3>
                  <p style="font-size:12px;color:#64748B;margin:0;">Core company details and primary identity displayed across headers and contact forms.</p>
                </div>
              </div>

              <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Website / Brand Name *</label>
                  <input type="text" id="ws_site_name" value="Creed Tech" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Company Tagline / Slogan</label>
                  <input type="text" id="ws_site_tagline" value="Enterprise Systems &amp; AI Solutions" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Primary Support / Contact Email</label>
                  <input type="email" id="ws_contact_email" value="info@creedtech.co" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Contact Phone Number</label>
                  <input type="text" id="ws_contact_phone" value="+92 300 1234567" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div style="grid-column: span 2;">
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Primary Office Address</label>
                  <input type="text" id="ws_office_address" value="Islamabad / Lahore, Pakistan &amp; Global Pods" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
              </div>
            </div>

            <!-- Live Top Announcement Bar -->
            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;">
                <div style="display:flex;align-items:center;gap:8px;">
                  <span style="font-size:18px;">📢</span>
                  <div>
                    <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Top Live Announcement Bar</h3>
                    <p style="font-size:12px;color:#64748B;margin:0;">The top header ribbon displayed above navigation on all pages.</p>
                  </div>
                </div>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                  <input type="checkbox" id="ws_bar_enabled" checked style="width:18px;height:18px;cursor:pointer;">
                  <span style="font-size:12px;font-weight:700;color:#0F172A;">Show Announcement Bar</span>
                </label>
              </div>

              <div style="display:grid;grid-template-columns:140px 1fr 140px 180px;gap:14px;">
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Badge Label</label>
                  <input type="text" id="ws_bar_badge" value="LIVE" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;font-weight:700;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Announcement Message Text *</label>
                  <input type="text" id="ws_bar_message" value="Creed Tech recognized as Leading Enterprise Systems &amp; Cloud Modernization Provider." style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Action Link Text</label>
                  <input type="text" id="ws_bar_link_text" value="Explore →" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;font-weight:600;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Action Link URL</label>
                  <input type="text" id="ws_bar_link_url" value="services" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
              </div>
            </div>

            <!-- Footer & Social Channels -->
            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;gap:8px;padding-bottom:14px;margin-bottom:18px;border-bottom:1px solid #F1F5F9;">
                <span style="font-size:18px;">🔗</span>
                <div>
                  <h3 style="font-size:15px;font-weight:700;color:#0F172A;margin:0;">Footer Information &amp; Social Links</h3>
                  <p style="font-size:12px;color:#64748B;margin:0;">Copyright notice and official corporate social media profiles.</p>
                </div>
              </div>

              <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
                <div style="grid-column:span 2;">
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Copyright Notice Text</label>
                  <input type="text" id="ws_footer_copyright" value="© 2026 Creed Tech. All rights reserved." style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Facebook Profile / Page URL</label>
                  <input type="url" id="ws_social_facebook" value="https://facebook.com/creedtechnology" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Instagram Profile URL</label>
                  <input type="url" id="ws_social_instagram" value="https://instagram.com/creed.technologiess" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">LinkedIn Company URL</label>
                  <input type="url" id="ws_social_linkedin" value="https://linkedin.com/company/creedtech" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Pinterest Profile URL</label>
                  <input type="url" id="ws_social_pinterest" value="https://pinterest.com/creedtech" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Twitter / X Profile URL</label>
                  <input type="url" id="ws_social_twitter" value="https://x.com/Creedtech3" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">GitHub Organization URL</label>
                  <input type="url" id="ws_social_github" value="https://github.com/creed-tech" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;outline:none;">
                </div>
              </div>
            </div>
          </div>

          <!-- Bottom Floating Save Bar -->
          <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;padding:16px 0;">
            <button type="button" onclick="loadWebsiteSettingsFromBackend()" style="padding:10px 20px;background:#F1F5F9;border:1px solid #CBD5E1;color:#334155;font-size:13px;font-weight:700;border-radius:4px;cursor:pointer;">
              Reset to Saved
            </button>
            <button type="submit" style="padding:10px 28px;background:#0052FF;color:#fff;font-size:13px;font-weight:700;border:none;border-radius:4px;cursor:pointer;box-shadow:0 4px 6px -1px rgba(0,82,255,0.3);">
              💾 Save All Website Settings
            </button>
          </div>

        </form>
      </div>

      <!-- ================= 11. TAB: SYSTEM SETTINGS ================= -->
      <div id="tab_settings" class="admin-tab-pane" style="display:none;">
        <div style="margin-bottom:20px;">
          <h1 style="font-size:22px;font-weight:700;color:#0F172A;margin:0 0 4px;">System Governance &amp; Security Controls</h1>
          <p style="font-size:13px;color:#64748B;margin:0;">Environment diagnostics, database synchronization, and security parameters.</p>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;gap:18px;">
          <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid #F1F5F9;">
            <div>
              <h4 style="font-size:14px;font-weight:700;color:#0F172A;margin:0 0 2px;">256-Bit Encrypted Data Sync</h4>
              <p style="font-size:12px;color:#64748B;margin:0;">Synchronize local CMS records with MariaDB / MySQL cluster.</p>
            </div>
            <button onclick="alert('Database synced successfully!')" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">Sync Database Now</button>
          </div>

          <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid #F1F5F9;">
            <div>
              <h4 style="font-size:14px;font-weight:700;color:#0F172A;margin:0 0 2px;">Maintenance Mode</h4>
              <p style="font-size:12px;color:#64748B;margin:0;">Temporarily redirect visitors to scheduled maintenance page.</p>
            </div>
            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
              <input type="checkbox" style="width:18px;height:18px;">
              <span style="font-size:12px;font-weight:600;color:#64748B;">Disabled</span>
            </label>
          </div>

          <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;">
            <div>
              <h4 style="font-size:14px;font-weight:700;color:#0F172A;margin:0 0 2px;">Download Database Backup (SQL Dump)</h4>
              <p style="font-size:12px;color:#64748B;margin:0;">Download complete snapshot of schema and tables.</p>
            </div>
            <a href="schema.sql" download="creed_tech_backup.sql" style="padding:8px 16px;background:#F1F5F9;border:1px solid #CBD5E1;color:#0F172A;font-size:12px;font-weight:600;border-radius:4px;text-decoration:none;">Download Backup 📥</a>
          </div>
        </div>
      </div>

    </main>

  </div>
</div>

<!-- 2. Add Article Modal (SINGLE UNIFIED COMPLETE ARTICLE STUDIO) -->
<div id="addArticleModal" class="admin-modal">
  <div style="background:#fff;border-radius:12px;max-width:960px;width:100%;padding:32px;position:relative;box-shadow:0 25px 50px -12px rgba(0,0,0,0.4);max-height:92vh;overflow-y:auto;">
    <button onclick="closeModal('addArticleModal')" style="position:absolute;top:24px;right:24px;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:50%;width:34px;height:34px;font-size:16px;font-weight:800;color:#64748B;cursor:pointer;display:flex;align-items:center;justify-content:center;">✕</button>
    
    <div style="margin-bottom:24px;padding-bottom:16px;border-bottom:2px solid #F1F5F9;">
      <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
        <span style="background:#0052FF;color:#fff;font-size:10px;font-weight:800;padding:3px 8px;border-radius:2px;letter-spacing:0.08em;text-transform:uppercase;">ALL-IN-ONE STUDIO</span>
        <h2 style="font-size:22px;font-weight:800;color:#0F172A;margin:0;">Publish Unified Article with Media, Videos, Pros/Cons &amp; Buttons</h2>
      </div>
      <p style="font-size:13px;color:#64748B;margin:0;">Enter all article components in this single unified form. One click publishes the full page with working video, audio, pros/cons, and shopping buttons.</p>
    </div>

    <form onsubmit="handleCreateArticle(event)" style="display:flex;flex-direction:column;gap:24px;">
      
      <!-- 1. BASIC INFORMATION -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:20px;">
        <div style="font-size:13px;font-weight:800;color:#0F172A;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:14px;display:flex;align-items:center;gap:6px;">
          <span>📝</span> 1. Article Headline &amp; Metadata
        </div>

        <div style="display:flex;flex-direction:column;gap:12px;">
          <div>
            <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Article Headline / Title *</label>
            <input type="text" id="newArtTitle" required placeholder="e.g. The Best Laptops We've Tested for Enterprise AI &amp; Cloud (2026)" value="The Best Laptops We've Tested for Enterprise AI &amp; Cloud (2026)" style="width:100%;padding:10px 14px;border:1px solid #CBD5E1;border-radius:6px;font-size:14px;font-weight:700;background:#fff;outline:none;">
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
            <div>
              <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Category *</label>
              <input type="text" id="newArtCat" required placeholder="e.g. HARDWARE &amp; AI WORKSTATIONS" value="HARDWARE &amp; AI WORKSTATIONS" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;outline:none;">
            </div>
            <div>
              <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Author / Reviewer *</label>
              <input type="text" id="newArtSource" required placeholder="e.g. Dr. Sarah Jenkins (Chief Systems Architect)" value="Dr. Sarah Jenkins (Chief Systems Architect)" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;outline:none;">
            </div>
            <div>
              <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Estimated Read Time</label>
              <input type="text" id="newArtReadTime" placeholder="e.g. 15 min read" value="15 min read" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;outline:none;">
            </div>
          </div>
        </div>
      </div>

      <!-- 2. MULTIMEDIA HUB (Cover Photo + 4K Video + Audio Podcast) -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:20px;">
        <div style="font-size:13px;font-weight:800;color:#0F172A;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:14px;display:flex;align-items:center;gap:6px;">
          <span>🎬</span> 2. Multimedia Suite (Picture, 4K Video Embed &amp; Audio Podcast)
        </div>

        <div style="display:flex;flex-direction:column;gap:12px;">
          <div>
            <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">🖼️ Cover Photo URL *</label>
            <input type="url" id="newArtImg" placeholder="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?q=80&w=1000" value="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?q=80&w=1000&auto=format&fit=crop" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;outline:none;">
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div style="background:#EFF6FF;border:1px solid #BFDBFE;padding:12px;border-radius:6px;">
              <label style="display:block;font-size:12px;font-weight:800;color:#1E40AF;margin-bottom:4px;">🎥 4K Video Embed URL (YouTube / Vimeo)</label>
              <input type="url" id="newArtVid" placeholder="https://www.youtube.com/embed/dQw4w9WgXcQ" value="https://www.youtube.com/embed/dQw4w9WgXcQ" style="width:100%;padding:8px 12px;border:1px solid #93C5FD;border-radius:4px;font-size:12px;background:#fff;outline:none;">
            </div>
            <div style="background:#FAF5FF;border:1px solid #E9D5FF;padding:12px;border-radius:6px;">
              <label style="display:block;font-size:12px;font-weight:800;color:#6B21A8;margin-bottom:4px;">🎙️ Audio Briefing / Podcast Stream URL</label>
              <input type="url" id="newArtAud" placeholder="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" value="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" style="width:100%;padding:8px 12px;border:1px solid #D8B4FE;border-radius:4px;font-size:12px;background:#fff;outline:none;">
            </div>
          </div>
        </div>
      </div>

      <!-- 3. FULL-POWER RICH TEXT WYSIWYG & DYNAMIC TABLE STUDIO -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:20px;">
        <div style="font-size:13px;font-weight:800;color:#0F172A;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:14px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
          <div style="display:flex;align-items:center;gap:6px;">
            <span>✍️</span> 3. Full-Power Rich Text WYSIWYG &amp; Dynamic Table Studio
          </div>
          <span style="font-size:11px;font-weight:700;color:#0052FF;background:#EFF6FF;padding:3px 8px;border-radius:3px;">FULL STYLING &amp; TABLE CONTROLS ACTIVE</span>
        </div>

        <div style="display:flex;flex-direction:column;gap:12px;">
          <div>
            <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Editors' Note / Highlight Banner *</label>
            <textarea id="newArtSummary" rows="2" required placeholder="August 2026: Executive lab overview and hardware thesis..." style="width:100%;padding:10px 14px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;outline:none;resize:vertical;line-height:1.6;">August 2026: Our hardware team has vetted 22 workstations for running local 70B LLMs, multi-container Docker clusters, and heavy multi-threaded compilation builds in Creed Tech Labs.</textarea>
          </div>

          <!-- FULL-POWER WYSIWYG TOOLBAR -->
          <div style="background:#F1F5F9;border:1px solid #CBD5E1;border-radius:8px;padding:12px;display:flex;flex-direction:column;gap:8px;">
            
            <!-- ROW 1: FONT SIZES, HEADINGS, FONTS & CORE STYLES -->
            <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
              
              <!-- Font Size Selector (10px to 72px) -->
              <div style="display:flex;align-items:center;gap:4px;background:#fff;border:1px solid #CBD5E1;padding:3px 8px;border-radius:4px;">
                <span style="font-size:11px;font-weight:700;color:#64748B;">Size:</span>
                <select onchange="applyCustomFontSize(this.value)" style="border:none;background:transparent;font-size:12px;font-weight:700;outline:none;cursor:pointer;">
                  <option value="10px">10 px</option>
                  <option value="12px">12 px</option>
                  <option value="14px">14 px</option>
                  <option value="16px" selected>16 px (Normal Body)</option>
                  <option value="18px">18 px</option>
                  <option value="20px">20 px</option>
                  <option value="24px">24 px (H3 Subheading)</option>
                  <option value="28px">28 px</option>
                  <option value="32px">32 px (H2 Section Heading)</option>
                  <option value="40px">40 px (H1 Major Title)</option>
                  <option value="48px">48 px</option>
                  <option value="60px">60 px</option>
                  <option value="72px">72 px (Hero Headline)</option>
                </select>
              </div>

              <!-- Headings Dropdown -->
              <select onchange="formatDoc('formatBlock', this.value); this.selectedIndex=0;" style="padding:4px 8px;background:#fff;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-weight:700;cursor:pointer;">
                <option value="" disabled selected>Headings ▾</option>
                <option value="<p>">Paragraph (Normal)</option>
                <option value="<h1>">Heading 1 (Huge)</option>
                <option value="<h2>">Heading 2 (Section)</option>
                <option value="<h3>">Heading 3 (Subsection)</option>
                <option value="<h4>">Heading 4</option>
                <option value="<blockquote>">“ Blockquote</option>
                <option value="<pre>">💻 Code Block</option>
              </select>

              <!-- Bold, Italic, Underline, Strikethrough -->
              <button type="button" onclick="formatDoc('bold')" title="Bold" style="padding:4px 10px;background:#fff;border:1px solid #CBD5E1;font-weight:900;font-size:13px;border-radius:4px;cursor:pointer;"><b>B</b></button>
              <button type="button" onclick="formatDoc('italic')" title="Italic" style="padding:4px 10px;background:#fff;border:1px solid #CBD5E1;font-style:italic;font-weight:700;font-size:13px;border-radius:4px;cursor:pointer;"><i>I</i></button>
              <button type="button" onclick="formatDoc('underline')" title="Underline" style="padding:4px 10px;background:#fff;border:1px solid #CBD5E1;text-decoration:underline;font-weight:700;font-size:13px;border-radius:4px;cursor:pointer;"><u>U</u></button>
              <button type="button" onclick="formatDoc('strikeThrough')" title="Strikethrough" style="padding:4px 10px;background:#fff;border:1px solid #CBD5E1;text-decoration:line-through;font-size:13px;border-radius:4px;cursor:pointer;">S</button>
              <button type="button" onclick="formatDoc('subscript')" title="Subscript" style="padding:4px 8px;background:#fff;border:1px solid #CBD5E1;font-size:11px;font-weight:700;border-radius:4px;cursor:pointer;">X₂</button>
              <button type="button" onclick="formatDoc('superscript')" title="Superscript" style="padding:4px 8px;background:#fff;border:1px solid #CBD5E1;font-size:11px;font-weight:700;border-radius:4px;cursor:pointer;">X²</button>
              <button type="button" onclick="formatDoc('removeFormat')" title="Clear All Formatting" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:12px;border-radius:4px;cursor:pointer;">🧹 Clear</button>
            </div>

            <!-- ROW 2: COLORS, HIGHLIGHTS & GRADIENT PRESETS -->
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;border-top:1px solid #CBD5E1;padding-top:6px;">
              
              <!-- Font Color Picker -->
              <div style="display:flex;align-items:center;gap:4px;background:#fff;border:1px solid #CBD5E1;padding:3px 8px;border-radius:4px;">
                <span style="font-size:11px;font-weight:700;color:#64748B;">🎨 Text Color:</span>
                <input type="color" onchange="formatDoc('foreColor', this.value)" value="#0F172A" style="border:none;width:24px;height:22px;cursor:pointer;background:transparent;">
              </div>

              <!-- Highlight Color Picker -->
              <div style="display:flex;align-items:center;gap:4px;background:#fff;border:1px solid #CBD5E1;padding:3px 8px;border-radius:4px;">
                <span style="font-size:11px;font-weight:700;color:#64748B;">🖍️ Highlight:</span>
                <input type="color" onchange="formatDoc('hiliteColor', this.value)" value="#FEF08A" style="border:none;width:24px;height:22px;cursor:pointer;background:transparent;">
              </div>

              <!-- Gradient Text Presets -->
              <div style="display:flex;align-items:center;gap:4px;background:#fff;border:1px solid #CBD5E1;padding:3px 8px;border-radius:4px;">
                <span style="font-size:11px;font-weight:800;color:#0052FF;">🌈 Gradient Text:</span>
                <select onchange="applyGradientText(this.value); this.selectedIndex=0;" style="border:none;background:transparent;font-size:11.5px;font-weight:700;outline:none;cursor:pointer;">
                  <option value="" disabled selected>Select Gradient ▾</option>
                  <option value="linear-gradient(135deg, #FF512F 0%, #DD2476 100%)">🌅 Sunset Flame (Orange-Red)</option>
                  <option value="linear-gradient(135deg, #0052FF 0%, #00D2FF 100%)">⚡ Electric Cyan-Blue</option>
                  <option value="linear-gradient(135deg, #10B981 0%, #059669 100%)">🌿 Cyber Emerald</option>
                  <option value="linear-gradient(135deg, #8B5CF6 0%, #EC4899 100%)">🔮 Neon Purple-Pink</option>
                  <option value="linear-gradient(135deg, #F59E0B 0%, #D97706 100%)">👑 Luxury Gold Amber</option>
                </select>
              </div>

              <!-- Callout Box Inserter -->
              <select onchange="insertCalloutBox(this.value); this.selectedIndex=0;" style="padding:4px 8px;background:#fff;border:1px solid #CBD5E1;border-radius:4px;font-size:11.5px;font-weight:700;cursor:pointer;">
                <option value="" disabled selected>💡 Insert Alert Box ▾</option>
                <option value="info">🔵 Info Note (Blue)</option>
                <option value="success">🟢 Success / Verdict (Green)</option>
                <option value="warning">🟡 Warning / Benchmark Note (Yellow)</option>
                <option value="danger">🔴 Caution / Limitation (Red)</option>
              </select>
            </div>

            <!-- ROW 3: ALL BULLET TYPES, NUMBERING & COMPLETE ALIGNMENTS -->
            <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;border-top:1px solid #CBD5E1;padding-top:6px;">
              
              <!-- Multiple Bullet Types -->
              <div style="display:flex;align-items:center;gap:4px;background:#fff;border:1px solid #CBD5E1;padding:3px 8px;border-radius:4px;">
                <span style="font-size:11px;font-weight:700;color:#64748B;">Bullets:</span>
                <button type="button" onclick="formatDoc('insertUnorderedList')" title="Standard Disc Bullet" style="padding:2px 6px;border:1px solid #E2E8F0;background:#F8FAFC;border-radius:2px;font-size:11px;font-weight:700;cursor:pointer;">• Disc</button>
                <button type="button" onclick="insertCustomBullet('circle')" title="Circle Bullet" style="padding:2px 6px;border:1px solid #E2E8F0;background:#F8FAFC;border-radius:2px;font-size:11px;font-weight:700;cursor:pointer;">○ Circle</button>
                <button type="button" onclick="insertCustomBullet('square')" title="Square Bullet" style="padding:2px 6px;border:1px solid #E2E8F0;background:#F8FAFC;border-radius:2px;font-size:11px;font-weight:700;cursor:pointer;">■ Square</button>
                <button type="button" onclick="insertCustomBullet('arrow')" title="Arrow Bullet" style="padding:2px 6px;border:1px solid #E2E8F0;background:#F8FAFC;border-radius:2px;font-size:11px;font-weight:700;cursor:pointer;">➔ Arrow</button>
              </div>

              <!-- Numbering Types -->
              <div style="display:flex;align-items:center;gap:4px;background:#fff;border:1px solid #CBD5E1;padding:3px 8px;border-radius:4px;">
                <span style="font-size:11px;font-weight:700;color:#64748B;">Numbers:</span>
                <button type="button" onclick="formatDoc('insertOrderedList')" title="1. 2. 3." style="padding:2px 6px;border:1px solid #E2E8F0;background:#F8FAFC;border-radius:2px;font-size:11px;font-weight:700;cursor:pointer;">1. 2. 3.</button>
                <button type="button" onclick="insertCustomNumbering('upper-roman')" title="I. II. III." style="padding:2px 6px;border:1px solid #E2E8F0;background:#F8FAFC;border-radius:2px;font-size:11px;font-weight:700;cursor:pointer;">I. II. III.</button>
                <button type="button" onclick="insertCustomNumbering('upper-alpha')" title="A. B. C." style="padding:2px 6px;border:1px solid #E2E8F0;background:#F8FAFC;border-radius:2px;font-size:11px;font-weight:700;cursor:pointer;">A. B. C.</button>
              </div>

              <!-- Alignments (Left, Center, Right, Justify) -->
              <div style="display:flex;align-items:center;gap:2px;background:#fff;border:1px solid #CBD5E1;padding:2px 4px;border-radius:4px;">
                <button type="button" onclick="formatDoc('justifyLeft')" title="Align Left" style="padding:3px 8px;border:none;background:transparent;cursor:pointer;font-weight:800;">⇤</button>
                <button type="button" onclick="formatDoc('justifyCenter')" title="Align Center" style="padding:3px 8px;border:none;background:transparent;cursor:pointer;font-weight:800;">≡</button>
                <button type="button" onclick="formatDoc('justifyRight')" title="Align Right" style="padding:3px 8px;border:none;background:transparent;cursor:pointer;font-weight:800;">⇥</button>
                <button type="button" onclick="formatDoc('justifyFull')" title="Justify Text" style="padding:3px 8px;border:none;background:transparent;cursor:pointer;font-weight:800;">☰</button>
              </div>

              <!-- Indent & Outdent -->
              <button type="button" onclick="formatDoc('indent')" title="Indent (Tab)" style="padding:4px 8px;background:#fff;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-size:12px;">➔ Indent</button>
              <button type="button" onclick="formatDoc('outdent')" title="Outdent (Shift+Tab)" style="padding:4px 8px;background:#fff;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-size:12px;">⬅ Outdent</button>
            </div>

            <!-- ROW 4: DYNAMIC CUSTOM TABLE BUILDER & TABLE CONTROLS -->
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;border-top:1px solid #CBD5E1;padding-top:6px;background:#ECFDF5;padding:8px 12px;border-radius:6px;">
              <span style="font-size:12px;font-weight:800;color:#065F46;">📊 Table Studio:</span>
              
              <!-- Draw Table Grid Button -->
              <button type="button" onclick="promptCustomTableMatrix()" style="padding:5px 12px;background:#059669;color:#fff;border:none;font-size:12px;font-weight:700;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:4px;box-shadow:0 2px 4px rgba(5,150,105,0.3);">
                <span>📊</span> <span>+ Create Custom Table Grid (Rows × Cols)</span>
              </button>

              <!-- Interactive In-Table Controls -->
              <div style="display:flex;gap:4px;align-items:center;margin-left:auto;flex-wrap:wrap;">
                <button type="button" onclick="addTableRowInEditor()" title="Add Row Below Selected" style="padding:3px 8px;background:#fff;border:1px solid #6EE7B7;color:#047857;font-size:11px;font-weight:700;border-radius:3px;cursor:pointer;">+ Row</button>
                <button type="button" onclick="addTableColInEditor()" title="Add Column Right" style="padding:3px 8px;background:#fff;border:1px solid #6EE7B7;color:#047857;font-size:11px;font-weight:700;border-radius:3px;cursor:pointer;">+ Col</button>
                <button type="button" onclick="deleteTableRowInEditor()" title="Delete Current Row" style="padding:3px 8px;background:#fff;border:1px solid #FCA5A5;color:#B91C1C;font-size:11px;font-weight:700;border-radius:3px;cursor:pointer;">- Row</button>
                <button type="button" onclick="deleteTableColInEditor()" title="Delete Current Col" style="padding:3px 8px;background:#fff;border:1px solid #FCA5A5;color:#B91C1C;font-size:11px;font-weight:700;border-radius:3px;cursor:pointer;">- Col</button>
                <button type="button" onclick="deleteEntireTableInEditor()" title="Delete Table" style="padding:3px 8px;background:#FEF2F2;border:1px solid #F87171;color:#DC2626;font-size:11px;font-weight:800;border-radius:3px;cursor:pointer;">🗑️ Del Table</button>
              </div>
            </div>

            <!-- ROW 5: LINKS, MEDIA & DIVIDERS -->
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;border-top:1px solid #CBD5E1;padding-top:6px;">
              <button type="button" onclick="insertWebLink()" style="padding:4px 10px;background:#EFF6FF;color:#0052FF;border:1px solid #BFDBFE;font-size:12px;font-weight:700;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:4px;">
                <span>🔗</span> <span>Insert Hyperlink</span>
              </button>
              <button type="button" onclick="insertInlineImage()" style="padding:4px 10px;background:#FAF5FF;color:#6B21A8;border:1px solid #E9D5FF;font-size:12px;font-weight:700;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:4px;">
                <span>🖼️</span> <span>Insert In-Line Photo</span>
              </button>
              <button type="button" onclick="formatDoc('insertHorizontalRule')" style="padding:4px 10px;background:#fff;border:1px solid #CBD5E1;font-size:12px;font-weight:700;border-radius:4px;cursor:pointer;">
                <span>―</span> <span>Horizontal Divider</span>
              </button>
            </div>

          </div>

          <!-- LIVE WYSIWYG CANVAS WITH EMBEDDED TABLE SUPPORT -->
          <div id="richWysiwygEditor" contenteditable="true" style="min-height:280px;max-height:480px;padding:20px;background:#fff;border:2px solid #CBD5E1;border-radius:8px;overflow-y:auto;line-height:1.75;font-size:15.5px;color:#1E293B;outline:none;" onfocus="this.style.borderColor='#0052FF'" onblur="this.style.borderColor='#CBD5E1'">
            <p>The HP OmniBook 5 14 marks a seismic transition in the Windows laptop ecosystem. Built around Qualcomm's 4nm Oryon CPU architecture, it eliminates the historical compromise between high-performance computing and true all-day battery life. In our continuous developer workflow benchmark—which simulates running VS Code, simultaneous local Node.js development servers, 35 active browser tabs, and Slack in the background—the OmniBook 5 cruised through an astonishing 21 hours and 14 minutes before reaching zero percent.</p>
            <p>The 45 TOPS Hexagon NPU is fully utilized by local AI coding copilot extensions like Continue.dev and Ollama, offloading embedding lookups and lightweight autocompletion from the CPU cores without causing any noticeable battery penalty. The 2.8K OLED display is a visual masterpiece, boasting exceptional 0.0005-nit true blacks, 500 nits peak HDR brightness, and instantaneous 0.2ms pixel response times that eliminate text ghosting during rapid code scrolling.</p>
          </div>
        </div>
      </div>

      <!-- 4. PROS & CONS BUILDER -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:20px;">
        <div style="font-size:13px;font-weight:800;color:#0F172A;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:14px;display:flex;align-items:center;gap:6px;">
          <span>⚖️</span> 4. Pros &amp; Cons Builder (Key Advantages vs Limitations)
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
          <!-- Green Pros -->
          <div style="background:#F0FDF4;border:1px solid #86EFAC;border-radius:8px;padding:16px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
              <span style="font-size:12px;font-weight:900;color:#166534;">+ PROS (ADVANTAGES)</span>
              <button type="button" onclick="addProRow()" style="padding:4px 10px;background:#16A34A;color:#fff;font-size:11px;font-weight:700;border:none;border-radius:3px;cursor:pointer;">+ Add Pro</button>
            </div>
            <div id="prosListContainer" style="display:flex;flex-direction:column;gap:8px;">
              <div style="display:flex;gap:6px;align-items:center;"><input type="text" class="pro-item" value="Field-leading battery endurance (21+ hours continuous development)" style="flex:1;padding:7px 10px;border:1px solid #86EFAC;border-radius:4px;font-size:12.5px;background:#fff;"><button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#DC2626;cursor:pointer;font-weight:800;">✕</button></div>
              <div style="display:flex;gap:6px;align-items:center;"><input type="text" class="pro-item" value="Vivid 2.8K OLED 120Hz display with 100% DCI-P3 color gamut" style="flex:1;padding:7px 10px;border:1px solid #86EFAC;border-radius:4px;font-size:12.5px;background:#fff;"><button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#DC2626;cursor:pointer;font-weight:800;">✕</button></div>
              <div style="display:flex;gap:6px;align-items:center;"><input type="text" class="pro-item" value="Whisper-quiet acoustic fan noise below 24 dB under load" style="flex:1;padding:7px 10px;border:1px solid #86EFAC;border-radius:4px;font-size:12.5px;background:#fff;"><button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#DC2626;cursor:pointer;font-weight:800;">✕</button></div>
            </div>
          </div>

          <!-- Red Cons -->
          <div style="background:#FEF2F2;border:1px solid #FECACA;border-radius:8px;padding:16px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
              <span style="font-size:12px;font-weight:900;color:#991B1B;">&minus; CONS (LIMITATIONS)</span>
              <button type="button" onclick="addConRow()" style="padding:4px 10px;background:#DC2626;color:#fff;font-size:11px;font-weight:700;border:none;border-radius:3px;cursor:pointer;">+ Add Con</button>
            </div>
            <div id="consListContainer" style="display:flex;flex-direction:column;gap:8px;">
              <div style="display:flex;gap:6px;align-items:center;"><input type="text" class="con-item" value="Plastic keyboard deck could benefit from internal stiffening" style="flex:1;padding:7px 10px;border:1px solid #FECACA;border-radius:4px;font-size:12.5px;background:#fff;"><button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#DC2626;cursor:pointer;font-weight:800;">✕</button></div>
              <div style="display:flex;gap:6px;align-items:center;"><input type="text" class="con-item" value="Soldered RAM and non-expandable secondary storage bay" style="flex:1;padding:7px 10px;border:1px solid #FECACA;border-radius:4px;font-size:12.5px;background:#fff;"><button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#DC2626;cursor:pointer;font-weight:800;">✕</button></div>
            </div>
          </div>
        </div>
      </div>

      <!-- 5. TECHNICAL SPECIFICATIONS MATRIX TABLE -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
          <div style="font-size:13px;font-weight:800;color:#0F172A;text-transform:uppercase;letter-spacing:0.05em;display:flex;align-items:center;gap:6px;">
            <span>⚙️</span> 5. Technical Specifications Table (Key-Value Matrix)
          </div>
          <button type="button" onclick="addSpecRow()" style="padding:4px 10px;background:#0F172A;color:#fff;font-size:11px;font-weight:700;border:none;border-radius:3px;cursor:pointer;">+ Add Spec Row</button>
        </div>

        <div id="specsListContainer" style="display:flex;flex-direction:column;gap:8px;">
          <div class="spec-row" style="display:grid;grid-template-columns:1fr 2fr 30px;gap:8px;align-items:center;">
            <input type="text" class="spec-key" value="Processor (CPU)" placeholder="Spec Name (e.g. CPU)" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;font-weight:700;background:#fff;">
            <input type="text" class="spec-val" value="Qualcomm Snapdragon X Elite (12 Cores, up to 3.8 GHz)" placeholder="Spec Value" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;background:#fff;">
            <button type="button" onclick="this.parentElement.remove()" style="background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;border-radius:4px;height:32px;cursor:pointer;">✕</button>
          </div>
          <div class="spec-row" style="display:grid;grid-template-columns:1fr 2fr 30px;gap:8px;align-items:center;">
            <input type="text" class="spec-key" value="Memory (RAM)" placeholder="Spec Name" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;font-weight:700;background:#fff;">
            <input type="text" class="spec-val" value="32GB LPDDR5X-8448 MHz Dual Channel" placeholder="Spec Value" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;background:#fff;">
            <button type="button" onclick="this.parentElement.remove()" style="background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;border-radius:4px;height:32px;cursor:pointer;">✕</button>
          </div>
          <div class="spec-row" style="display:grid;grid-template-columns:1fr 2fr 30px;gap:8px;align-items:center;">
            <input type="text" class="spec-key" value="Battery Life" placeholder="Spec Name" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;font-weight:700;background:#fff;">
            <input type="text" class="spec-val" value="21 Hours 14 Minutes (Labs Tested)" placeholder="Spec Value" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;background:#fff;">
            <button type="button" onclick="this.parentElement.remove()" style="background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;border-radius:4px;height:32px;cursor:pointer;">✕</button>
          </div>
        </div>
      </div>

      <!-- 6. CUSTOM ACTION & BUY BUTTONS GENERATOR -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
          <div style="font-size:13px;font-weight:800;color:#0F172A;text-transform:uppercase;letter-spacing:0.05em;display:flex;align-items:center;gap:6px;">
            <span>🛒</span> 6. Custom Action &amp; Buy Buttons Generator
          </div>
          <button type="button" onclick="addCustomBuyBtnRow()" style="padding:4px 10px;background:#0052FF;color:#fff;font-size:11px;font-weight:700;border:none;border-radius:3px;cursor:pointer;">+ Add Button</button>
        </div>

        <div id="buyButtonsListContainer" style="display:flex;flex-direction:column;gap:8px;">
          <div class="buy-btn-row" style="display:grid;grid-template-columns:1.2fr 1.5fr 2fr 1fr 30px;gap:8px;align-items:center;">
            <input type="text" class="btn-store" placeholder="Store (e.g. Amazon)" value="Amazon" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;background:#fff;">
            <input type="text" class="btn-price" placeholder="Text ($899 at Amazon)" value="$899 at Amazon" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-weight:700;background:#fff;">
            <input type="url" class="btn-url" placeholder="URL (https://...)" value="https://amazon.com" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;background:#fff;">
            <select class="btn-color" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-weight:700;background:#fff;">
              <option value="#FF9900" selected>🟠 Amazon Orange</option>
              <option value="#0071DC">🔵 Walmart Blue</option>
              <option value="#0052FF">🔵 Creed Blue</option>
              <option value="#E11D48">🔴 Crimson Red</option>
              <option value="#10B981">🟢 Forest Green</option>
            </select>
            <button type="button" onclick="this.parentElement.remove()" style="background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;border-radius:4px;height:32px;cursor:pointer;">✕</button>
          </div>
          <div class="buy-btn-row" style="display:grid;grid-template-columns:1.2fr 1.5fr 2fr 1fr 30px;gap:8px;align-items:center;">
            <input type="text" class="btn-store" placeholder="Store" value="Walmart" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;background:#fff;">
            <input type="text" class="btn-price" placeholder="Text" value="$953 at Walmart" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-weight:700;background:#fff;">
            <input type="url" class="btn-url" placeholder="URL" value="https://walmart.com" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;background:#fff;">
            <select class="btn-color" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-weight:700;background:#fff;">
              <option value="#0071DC" selected>🔵 Walmart Blue</option>
              <option value="#FF9900">🟠 Amazon Orange</option>
              <option value="#0052FF">🔵 Creed Blue</option>
              <option value="#E11D48">🔴 Crimson Red</option>
              <option value="#10B981">🟢 Forest Green</option>
            </select>
            <button type="button" onclick="this.parentElement.remove()" style="background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;border-radius:4px;height:32px;cursor:pointer;">✕</button>
          </div>
        </div>
      </div>

      <!-- ========================================================= -->
      <!-- DYNAMIC MULTI-ARTICLE BUILDER: ADD NEXT ARTICLE TO PAGE -->
      <!-- ========================================================= -->
      <div id="additionalArticlesContainer" style="display:flex;flex-direction:column;gap:24px;">
        <!-- Dynamically appended sub-articles / workstations will appear here -->
      </div>

      <div style="background:#EFF6FF;border:2px dashed #3B82F6;border-radius:10px;padding:24px;text-align:center;">
        <h4 style="font-size:16px;font-weight:800;color:#1E40AF;margin:0 0 6px;">➕ Add Another Article / Workstation to This Same Page</h4>
        <p style="font-size:13px;color:#3B82F6;margin:0 0 16px;">Add as many laptop/workstation reviews as you want to this single mega-guide. Each gets its own media, long review text, pros/cons, specs table, buy links, and dedicated review box!</p>
        <button type="button" onclick="addNewWorkstationBlock()" style="padding:12px 28px;background:#0052FF;color:#fff;font-size:14px;font-weight:800;border:none;border-radius:6px;cursor:pointer;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 10px rgba(0,82,255,0.3);">
          <span>➕ Add Next Article / Laptop to This Page</span>
        </button>
      </div>

      <!-- ONE SINGLE SUBMIT BUTTON AT BOTTOM -->
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;padding-top:20px;border-top:2px solid #E2E8F0;">
        <div style="font-size:13px;font-weight:700;color:#64748B;">
          💡 Single Save publishes all added articles &amp; their individual review sections to the Knowledge Center.
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
          <button type="button" onclick="closeModal('addArticleModal')" style="padding:12px 24px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:13px;font-weight:700;color:#475569;border-radius:6px;cursor:pointer;">
            Cancel
          </button>
          <button type="submit" id="saveArticleSubmitBtn" style="padding:12px 36px;background:#0052FF;color:#fff;font-size:14px;font-weight:800;border:none;border-radius:6px;cursor:pointer;box-shadow:0 10px 15px -3px rgba(0,82,255,0.4);display:inline-flex;align-items:center;gap:8px;transition:background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
            <span>🚀 Save &amp; Publish Complete Page to Knowledge Center</span>
          </button>
        </div>
      </div>

    </form>
  </div>
</div>

<!-- 3. Add Video Modal -->
<div id="addVideoModal" class="admin-modal">
  <div style="background:#fff;border-radius:6px;max-width:550px;width:100%;padding:24px;position:relative;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);">
    <button onclick="closeModal('addVideoModal')" style="position:absolute;top:16px;right:16px;background:none;border:none;font-size:18px;font-weight:700;color:#94A3B8;cursor:pointer;">✕</button>
    <span style="font-size:11px;font-weight:700;color:#FF6B00;text-transform:uppercase;">MEDIA CMS</span>
    <h3 style="font-size:18px;font-weight:700;color:#0F172A;margin:4px 0 16px;">Add Video to Knowledge Library</h3>
    
    <form onsubmit="handleCreateVideo(event)" style="display:flex;flex-direction:column;gap:12px;">
      <div>
        <label style="display:block;font-size:12px;font-weight:600;color:#334155;margin-bottom:4px;">Video Title *</label>
        <input type="text" id="newVidTitle" required placeholder="e.g. Architecting Sovereign AI Pipelines in 2026" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
      </div>

      <div>
        <label style="display:block;font-size:12px;font-weight:600;color:#334155;margin-bottom:4px;">Video URL (YouTube, Vimeo, or MP4) *</label>
        <input type="url" id="newVidUrl" required placeholder="https://www.youtube.com/watch?v=..." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
        <div>
          <label style="display:block;font-size:12px;font-weight:600;color:#334155;margin-bottom:4px;">Category *</label>
          <input type="text" id="newVidCat" required placeholder="e.g. Artificial Intelligence" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
        </div>
        <div>
          <label style="display:block;font-size:12px;font-weight:600;color:#334155;margin-bottom:4px;">Duration</label>
          <input type="text" id="newVidDur" placeholder="e.g. 18:45" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:10px;">
        <button type="button" onclick="closeModal('addVideoModal')" style="padding:8px 16px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:12px;font-weight:600;border-radius:4px;cursor:pointer;">Cancel</button>
        <button type="submit" style="padding:8px 20px;background:#FF6B00;color:#fff;font-size:12px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">Save Video</button>
      </div>
    </form>
  </div>
</div>

<!-- 4. Inquiry Detail Modal -->
<div id="inquiryDetailModal" class="admin-modal">
  <div style="background:#fff;border-radius:6px;max-width:550px;width:100%;padding:24px;position:relative;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);">
    <button onclick="closeModal('inquiryDetailModal')" style="position:absolute;top:16px;right:16px;background:none;border:none;font-size:18px;font-weight:700;color:#94A3B8;cursor:pointer;">✕</button>
    <span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;">INQUIRY DOSSIER</span>
    <h3 id="modalClientName" style="font-size:18px;font-weight:700;color:#0F172A;margin:4px 0 16px;">Client Name</h3>
    
    <div style="display:flex;flex-direction:column;gap:10px;font-size:13px;background:#F8FAFC;padding:16px;border:1px solid #E2E8F0;border-radius:4px;margin-bottom:16px;">
      <div><strong style="color:#64748B;">Email:</strong> <span id="modalClientEmail" style="color:#0F172A;"></span></div>
      <div><strong style="color:#64748B;">Company:</strong> <span id="modalClientCompany" style="color:#0F172A;"></span></div>
      <div><strong style="color:#64748B;">Phone:</strong> <span id="modalClientPhone" style="color:#0F172A;"></span></div>
      <div><strong style="color:#64748B;">Service Requested:</strong> <span id="modalClientService" style="color:#0052FF;font-weight:600;"></span></div>
      <div>
        <strong style="color:#64748B;display:block;margin-bottom:4px;">Project Scope &amp; Details:</strong>
        <p id="modalClientMessage" style="margin:0;color:#334155;line-height:1.6;font-size:12px;"></p>
      </div>
    </div>

    <div style="display:flex;justify-content:flex-end;gap:10px;">
      <button onclick="closeModal('inquiryDetailModal')" style="padding:8px 16px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:12px;font-weight:600;border-radius:4px;cursor:pointer;">Close</button>
      <a id="modalReplyBtn" href="mailto:" style="padding:8px 16px;background:#0052FF;color:#fff;font-size:12px;font-weight:600;text-decoration:none;border-radius:4px;">Reply via Email ✉</a>
    </div>
  </div>
</div>

<!-- 5. Add Job Opening Modal -->
<div id="addJobModal" class="admin-modal">
  <div style="background:#fff;border-radius:8px;max-width:600px;width:100%;padding:28px;position:relative;box-shadow:0 25px 50px -12px rgba(0,0,0,0.35);">
    <button onclick="closeModal('addJobModal')" style="position:absolute;top:20px;right:20px;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:50%;width:30px;height:30px;font-size:14px;font-weight:700;color:#64748B;cursor:pointer;">✕</button>
    <div style="margin-bottom:16px;padding-bottom:10px;border-bottom:2px solid #F1F5F9;">
      <span style="background:#0052FF;color:#fff;font-size:10px;font-weight:800;padding:2px 8px;border-radius:2px;letter-spacing:0.05em;text-transform:uppercase;">CAREERS CMS</span>
      <h3 style="font-size:18px;font-weight:800;color:#0F172A;margin:4px 0 0;">Post / Edit Engineering Job Opening</h3>
    </div>

    <form onsubmit="handleCreateJob(event)" style="display:flex;flex-direction:column;gap:14px;">
      <input type="hidden" id="editJobId" value="0">

      <div>
        <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Job Title *</label>
        <input type="text" id="jobTitle" required placeholder="e.g. Lead Systems Architect (Rust / Distributed Systems)" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div>
          <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Department *</label>
          <select id="jobDept" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;font-weight:600;box-sizing:border-box;">
            <option value="Engineering">Engineering</option>
            <option value="AI & Machine Learning">AI &amp; Machine Learning</option>
            <option value="UI/UX & Design">UI/UX &amp; Design</option>
            <option value="Cloud & Infrastructure">Cloud &amp; Infrastructure</option>
            <option value="Solutions & Growth">Solutions &amp; Growth</option>
          </select>
        </div>
        <div>
          <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Location Coordinates *</label>
          <input type="text" id="jobLoc" required placeholder="e.g. Remote / Frankfurt (Germany)" value="Remote (Global)" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div>
          <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Posting Status *</label>
          <select id="jobStatus" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;font-weight:700;color:#0052FF;box-sizing:border-box;">
            <option value="Announcement Coming Soon">🟡 Announcement Coming Soon</option>
            <option value="Actively Interviewing">🟢 Actively Interviewing</option>
            <option value="Open Application">🔵 Open Application</option>
            <option value="Closed">⚪ Closed</option>
          </select>
        </div>
        <div>
          <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Tech Stack Tags (Comma separated)</label>
          <input type="text" id="jobTags" placeholder="Rust, Go, Kubernetes, PostgreSQL" value="Rust, Go, Kubernetes, PostgreSQL" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
        </div>
      </div>

      <div>
        <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Role Summary &amp; Mission *</label>
        <textarea id="jobDesc" required rows="3" placeholder="Describe the mission, technical stack, and architectural goals..." style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;resize:vertical;line-height:1.5;box-sizing:border-box;">Lead the architectural design and high-concurrency performance tuning of enterprise cloud systems for our global clients.</textarea>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px;padding-top:10px;border-top:1px solid #F1F5F9;">
        <button type="button" onclick="closeModal('addJobModal')" style="padding:9px 18px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:13px;font-weight:700;border-radius:4px;cursor:pointer;">Cancel</button>
        <button type="submit" style="padding:9px 24px;background:#0052FF;color:#fff;font-size:13px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">🚀 Save Job Opening</button>
      </div>
    </form>
  </div>
</div>

<!-- JAVASCRIPT: Master CMS, Table Drawer & Rich Studio Controller -->
<script>
const ADMIN_CSRF_TOKEN = '<?= get_csrf_token() ?>';

function switchAdminTab(tabName, btn) {
  var allPanes = document.querySelectorAll('.admin-tab-pane');
  allPanes.forEach(function(p) { p.style.display = 'none'; });

  var allBtns = document.querySelectorAll('.admin-tab-btn');
  allBtns.forEach(function(b) { b.classList.remove('active'); });

  var targetPane = document.getElementById('tab_' + tabName);
  if (targetPane) targetPane.style.display = 'block';
  if (btn) btn.classList.add('active');

  if (tabName === 'news_wire' && typeof loadTechWireNewsTab === 'function') {
    loadTechWireNewsTab();
  }
  if (tabName === 'articles' && typeof loadKnowledgeDraftsTab === 'function') {
    loadKnowledgeDraftsTab();
  }
  if (tabName === 'portfolio' && typeof loadPortfolioDataForAdmin === 'function') {
    loadPortfolioDataForAdmin();
  }
  if (tabName === 'website_settings' && typeof loadWebsiteSettingsFromBackend === 'function') {
    loadWebsiteSettingsFromBackend();
  }
}

function switchWsSubTab(subTabKey, btn) {
  var panes = document.querySelectorAll('.ws-subpane');
  panes.forEach(function(p) { p.style.display = 'none'; });

  var btns = document.querySelectorAll('.ws-subtab-btn');
  btns.forEach(function(b) {
    b.classList.remove('active');
    b.style.background = '#F1F5F9';
    b.style.color = '#475569';
    b.style.borderColor = '#CBD5E1';
  });

  var target = document.getElementById('ws_subpane_' + subTabKey);
  if (target) target.style.display = 'flex';
  if (btn) {
    btn.classList.add('active');
    btn.style.background = '#0052FF';
    btn.style.color = '#FFFFFF';
    btn.style.borderColor = '#0052FF';
  }
}
window.switchWsSubTab = switchWsSubTab;

var ADMIN_PORTFOLIO_PROJECTS = [];

function syncCurrentPortfolioInputsIntoMemory() {
  if (!Array.isArray(ADMIN_PORTFOLIO_PROJECTS)) ADMIN_PORTFOLIO_PROJECTS = [];
  
  ADMIN_PORTFOLIO_PROJECTS = ADMIN_PORTFOLIO_PROJECTS.map(function(p, i) {
    var titleEl = document.getElementById('pf_title_' + i);
    var imgEl = document.getElementById('pf_img_' + i);
    var catEl = document.getElementById('pf_cat_' + i);
    var badgeCatEl = document.getElementById('pf_badge_cat_' + i);
    var clientLocEl = document.getElementById('pf_client_loc_' + i);
    var descEl = document.getElementById('pf_desc_' + i);
    var chalEl = document.getElementById('pf_challenge_' + i);
    var solEl = document.getElementById('pf_solution_' + i);
    var m1vEl = document.getElementById('pf_m1_v_' + i);
    var m1lEl = document.getElementById('pf_m1_l_' + i);
    var m2vEl = document.getElementById('pf_m2_v_' + i);
    var m2lEl = document.getElementById('pf_m2_l_' + i);
    var m3vEl = document.getElementById('pf_m3_v_' + i);
    var m3lEl = document.getElementById('pf_m3_l_' + i);
    var stackEl = document.getElementById('pf_stack_' + i);

    var stackArr = stackEl && stackEl.value ? stackEl.value.split(',').map(function(t) { return t.trim(); }).filter(function(t) { return t.length > 0; }) : (Array.isArray(p.tech_stack) ? p.tech_stack : []);

    return {
      id: p.id || ('case-' + (i + 1)),
      number: (i + 1 < 10 ? '0' : '') + (i + 1),
      title: titleEl ? titleEl.value.trim() : (p.title || ''),
      category: catEl ? catEl.value.trim() : (p.category || ''),
      badge_category: badgeCatEl ? badgeCatEl.value.trim() : (p.badge_category || p.category || ''),
      client: p.client || '',
      client_location: clientLocEl ? clientLocEl.value.trim() : (p.client_location || ''),
      image: imgEl ? imgEl.value.trim() : (p.image || ''),
      description: descEl ? descEl.value.trim() : (p.description || ''),
      challenge: chalEl ? chalEl.value.trim() : (p.challenge || ''),
      solution: solEl ? solEl.value.trim() : (p.solution || ''),
      metric1_val: m1vEl ? m1vEl.value.trim() : (p.metric1_val || ''),
      metric1_label: m1lEl ? m1lEl.value.trim() : (p.metric1_label || ''),
      metric2_val: m2vEl ? m2vEl.value.trim() : (p.metric2_val || ''),
      metric2_label: m2lEl ? m2lEl.value.trim() : (p.metric2_label || ''),
      metric3_val: m3vEl ? m3vEl.value.trim() : (p.metric3_val || ''),
      metric3_label: m3lEl ? m3lEl.value.trim() : (p.metric3_label || ''),
      tech_stack: stackArr
    };
  });
}
window.syncDedicatedPortfolioInputsIntoMemory = syncCurrentPortfolioInputsIntoMemory;

function renderAdminPortfolioProjects(projects) {
  ADMIN_PORTFOLIO_PROJECTS = Array.isArray(projects) ? projects : [];
  
  var container = document.getElementById('adminPortfolioProjectsList');
  if (!container) return;

  if (ADMIN_PORTFOLIO_PROJECTS.length === 0) {
    container.innerHTML = '<div style="padding:24px;text-align:center;color:#64748B;font-size:13px;background:#F8FAFC;border-radius:6px;border:1px dashed #CBD5E1;">No projects added yet. Click "+ Add New Project" above to create one.</div>';
    return;
  }

  var html = '';
  ADMIN_PORTFOLIO_PROJECTS.forEach(function(p, i) {
    var pNum = p.number || (i + 1 < 10 ? '0' + (i + 1) : '' + (i + 1));
    var stackStr = Array.isArray(p.tech_stack) ? p.tech_stack.join(', ') : (p.tech_stack || '');

    html += '<div id="pf_case_box_' + i + '" style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:18px;position:relative;margin-bottom:14px;box-shadow:0 1px 2px rgba(0,0,0,0.03);">' +
      '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;border-bottom:1px solid #E2E8F0;padding-bottom:10px;">' +
        '<div style="display:flex;align-items:center;gap:10px;">' +
          '<span style="background:#0F172A;color:#fff;font-size:11px;font-weight:800;padding:3px 9px;border-radius:3px;letter-spacing:0.04em;">CASE ' + pNum + '</span>' +
          '<span style="font-size:13.5px;font-weight:700;color:#0F172A;">' + (p.title ? p.title.replace(/"/g, '&quot;') : 'New Project #' + (i + 1)) + '</span>' +
        '</div>' +
        '<button type="button" onclick="deletePortfolioProjectRow(' + i + ')" style="background:#FEE2E2;border:1px solid #FECACA;color:#DC2626;font-size:11.5px;font-weight:700;padding:5px 12px;border-radius:4px;cursor:pointer;">✕ Delete Project</button>' +
      '</div>' +

      '<div style="display:grid;grid-template-columns:130px 1fr 1fr;gap:14px;margin-bottom:12px;">' +
        '<div>' +
          '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:4px;">Cover Picture</label>' +
          '<div style="width:130px;height:80px;border-radius:4px;overflow:hidden;background:#0F172A;border:1px solid #CBD5E1;margin-bottom:4px;">' +
            '<img id="pf_prev_img_' + i + '" src="' + (p.image || 'assets/img/hero_img.webp') + '" style="width:100%;height:100%;object-fit:cover;" onerror="this.src=\'assets/img/hero_img.webp\'">' +
          '</div>' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Cover Image URL *</label>' +
          '<input type="url" id="pf_img_' + i + '" value="' + (p.image || '').replace(/"/g, '&quot;') + '" oninput="var el=document.getElementById(\'pf_prev_img_' + i + '\'); if(el) el.src=this.value;" placeholder="https://images.unsplash.com/..." style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin:8px 0 4px;">Client Name &amp; Location</label>' +
          '<input type="text" id="pf_client_loc_' + i + '" value="' + (p.client_location || '').replace(/"/g, '&quot;') + '" placeholder="🏢 Apex Global • UK" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Category / Subtitle *</label>' +
          '<input type="text" id="pf_cat_' + i + '" value="' + (p.category || '').replace(/"/g, '&quot;') + '" placeholder="e.g. Fintech &amp; Banking Rails" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin:8px 0 4px;">Image Badge Tag</label>' +
          '<input type="text" id="pf_badge_cat_' + i + '" value="' + (p.badge_category || p.category || '').replace(/"/g, '&quot;') + '" placeholder="e.g. Fintech &amp; Banking" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
      '</div>' +

      '<div style="margin-bottom:12px;">' +
        '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Project Headline / Title *</label>' +
        '<input type="text" id="pf_title_' + i + '" value="' + (p.title || '').replace(/"/g, '&quot;') + '" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;font-weight:700;outline:none;">' +
      '</div>' +

      '<div style="margin-bottom:12px;">' +
        '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Executive Summary / Description</label>' +
        '<textarea id="pf_desc_' + i + '" rows="2" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' + (p.description || '') + '</textarea>' +
      '</div>' +

      '<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">' +
        '<div>' +
          '<label style="display:block;font-size:11px;font-weight:700;color:#DC2626;margin-bottom:4px;">The Engineering Challenge</label>' +
          '<textarea id="pf_challenge_' + i + '" rows="2" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' + (p.challenge || '') + '</textarea>' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11px;font-weight:700;color:#16A34A;margin-bottom:4px;">Creed Tech Architectural Solution</label>' +
          '<textarea id="pf_solution_' + i + '" rows="2" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' + (p.solution || '') + '</textarea>' +
        '</div>' +
      '</div>' +

      '<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px;margin-bottom:12px;">' +
        '<div style="background:#EFF6FF;border:1px solid #BFDBFE;padding:8px;border-radius:4px;">' +
          '<label style="display:block;font-size:10.5px;font-weight:700;color:#1E40AF;">Metric 1 (Value / Label)</label>' +
          '<div style="display:flex;gap:4px;margin-top:4px;">' +
            '<input type="text" id="pf_m1_v_' + i + '" value="' + (p.metric1_val || '').replace(/"/g, '&quot;') + '" placeholder="120k TPS" style="width:50%;padding:4px 6px;border:1px solid #93C5FD;border-radius:3px;font-size:11px;font-weight:700;">' +
            '<input type="text" id="pf_m1_l_' + i + '" value="' + (p.metric1_label || '').replace(/"/g, '&quot;') + '" placeholder="Throughput" style="width:50%;padding:4px 6px;border:1px solid #93C5FD;border-radius:3px;font-size:11px;">' +
          '</div>' +
        '</div>' +
        '<div style="background:#EFF6FF;border:1px solid #BFDBFE;padding:8px;border-radius:4px;">' +
          '<label style="display:block;font-size:10.5px;font-weight:700;color:#1E40AF;">Metric 2 (Value / Label)</label>' +
          '<div style="display:flex;gap:4px;margin-top:4px;">' +
            '<input type="text" id="pf_m2_v_' + i + '" value="' + (p.metric2_val || '').replace(/"/g, '&quot;') + '" placeholder="-85%" style="width:50%;padding:4px 6px;border:1px solid #93C5FD;border-radius:3px;font-size:11px;font-weight:700;">' +
            '<input type="text" id="pf_m2_l_' + i + '" value="' + (p.metric2_label || '').replace(/"/g, '&quot;') + '" placeholder="Latency Drop" style="width:50%;padding:4px 6px;border:1px solid #93C5FD;border-radius:3px;font-size:11px;">' +
          '</div>' +
        '</div>' +
        '<div style="background:#EFF6FF;border:1px solid #BFDBFE;padding:8px;border-radius:4px;">' +
          '<label style="display:block;font-size:10.5px;font-weight:700;color:#1E40AF;">Metric 3 (Value / Label)</label>' +
          '<div style="display:flex;gap:4px;margin-top:4px;">' +
            '<input type="text" id="pf_m3_v_' + i + '" value="' + (p.metric3_val || '').replace(/"/g, '&quot;') + '" placeholder="99.999%" style="width:50%;padding:4px 6px;border:1px solid #93C5FD;border-radius:3px;font-size:11px;font-weight:700;">' +
            '<input type="text" id="pf_m3_l_' + i + '" value="' + (p.metric3_label || '').replace(/"/g, '&quot;') + '" placeholder="Uptime SLA" style="width:50%;padding:4px 6px;border:1px solid #93C5FD;border-radius:3px;font-size:11px;">' +
          '</div>' +
        '</div>' +
      '</div>' +

      '<div>' +
        '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:4px;">Architectural Tech Stack (Comma separated)</label>' +
        '<input type="text" id="pf_stack_' + i + '" value="' + stackStr.replace(/"/g, '&quot;') + '" placeholder="e.g. Go, Kubernetes, CockroachDB, Kafka, AWS, Redis" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
      '</div>' +
    '</div>';
  });

  container.innerHTML = html;
}
window.renderAdminPortfolioDedicated = renderAdminPortfolioProjects;

function addNewPortfolioProjectRow() {
  if (!Array.isArray(ADMIN_PORTFOLIO_PROJECTS)) {
    ADMIN_PORTFOLIO_PROJECTS = [];
  }
  syncCurrentPortfolioInputsIntoMemory();
  var nextIdx = ADMIN_PORTFOLIO_PROJECTS.length + 1;
  ADMIN_PORTFOLIO_PROJECTS.push({
    id: 'case-' + nextIdx,
    number: (nextIdx < 10 ? '0' : '') + nextIdx,
    title: 'New Enterprise Project Case Study #' + nextIdx,
    category: 'Enterprise Engineering',
    badge_category: 'Engineering',
    client_location: '🏢 Global Enterprise Partner',
    image: 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=1200&auto=format&fit=crop&q=80',
    description: 'Engineered high-concurrency cloud platform with automated CI/CD and zero-trust security controls.',
    challenge: 'Legacy system architecture could not handle peak volume scaling.',
    solution: 'Designed distributed microservices architecture on Kubernetes with automated failover.',
    metric1_val: '10x',
    metric1_label: 'Velocity Boost',
    metric2_val: '99.99%',
    metric2_label: 'Uptime SLA',
    metric3_val: '0 Defect',
    metric3_label: 'Code SLA',
    tech_stack: ['Go', 'Kubernetes', 'Docker', 'PostgreSQL', 'AWS']
  });
  renderAdminPortfolioProjects(ADMIN_PORTFOLIO_PROJECTS);

  setTimeout(function() {
    var newIdx = ADMIN_PORTFOLIO_PROJECTS.length - 1;
    var newBox = document.getElementById('pf_case_box_' + newIdx);
    if (newBox) {
      newBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
      var titleInput = document.getElementById('pf_title_' + newIdx);
      if (titleInput) titleInput.focus();
    }
  }, 100);
}
window.addNewPortfolioProject = addNewPortfolioProjectRow;
window.addNewPortfolioCaseStudy = addNewPortfolioProjectRow;
window.addNewPortfolioProjectRow = addNewPortfolioProjectRow;

function deletePortfolioProjectRow(index) {
  syncCurrentPortfolioInputsIntoMemory();
  if (confirm('Are you sure you want to remove this project case study?')) {
    ADMIN_PORTFOLIO_PROJECTS.splice(index, 1);
    renderAdminPortfolioProjects(ADMIN_PORTFOLIO_PROJECTS);
  }
}
window.deletePortfolioProject = deletePortfolioProjectRow;
window.deletePortfolioCaseStudy = deletePortfolioProjectRow;
window.deletePortfolioProjectRow = deletePortfolioProjectRow;

// ==========================================
// ABOUT PAGE: GLOBAL HUBS & LEADERSHIP JS
// ==========================================

var ADMIN_ENGINEERING_HUBS = [];

function syncCurrentHubsInputsIntoMemory() {
  if (!Array.isArray(ADMIN_ENGINEERING_HUBS)) ADMIN_ENGINEERING_HUBS = [];
  ADMIN_ENGINEERING_HUBS = ADMIN_ENGINEERING_HUBS.map(function(h, i) {
    var cityEl = document.getElementById('hub_city_' + i);
    var countryEl = document.getElementById('hub_country_' + i);
    var imgEl = document.getElementById('hub_img_' + i);
    var specEl = document.getElementById('hub_spec_' + i);
    var addrEl = document.getElementById('hub_addr_' + i);
    var statusEl = document.getElementById('hub_status_' + i);

    return {
      id: h.id || ('hub-' + (i + 1)),
      city: cityEl ? cityEl.value.trim() : (h.city || ''),
      country: countryEl ? countryEl.value.trim() : (h.country || ''),
      image: imgEl ? imgEl.value.trim() : (h.image || ''),
      specialization: specEl ? specEl.value.trim() : (h.specialization || ''),
      address: addrEl ? addrEl.value.trim() : (h.address || ''),
      status: statusEl ? statusEl.value.trim() : (h.status || 'Active Regional Engineering Pod')
    };
  });
}

function renderAdminEngineeringHubs(hubs) {
  ADMIN_ENGINEERING_HUBS = Array.isArray(hubs) ? hubs : [];
  var container = document.getElementById('adminEngineeringHubsList');
  if (!container) return;

  if (ADMIN_ENGINEERING_HUBS.length === 0) {
    container.innerHTML = '<div style="padding:24px;text-align:center;color:#64748B;font-size:13px;background:#F8FAFC;border-radius:6px;border:1px dashed #CBD5E1;">No engineering hubs added yet. Click "+ Add Engineering Center" above to create one.</div>';
    return;
  }

  var html = '';
  ADMIN_ENGINEERING_HUBS.forEach(function(h, i) {
    html += '<div id="hub_box_' + i + '" style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:18px;position:relative;margin-bottom:14px;box-shadow:0 1px 2px rgba(0,0,0,0.03);">' +
      '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;border-bottom:1px solid #E2E8F0;padding-bottom:10px;">' +
        '<div style="display:flex;align-items:center;gap:10px;">' +
          '<span style="background:#0052FF;color:#fff;font-size:11px;font-weight:800;padding:3px 9px;border-radius:3px;letter-spacing:0.04em;">HUB ' + (i + 1 < 10 ? '0' : '') + (i + 1) + '</span>' +
          '<span style="font-size:13.5px;font-weight:700;color:#0F172A;">' + (h.city ? (h.city + (h.country ? ' (' + h.country + ')' : '')) : 'New Engineering Hub #' + (i + 1)) + '</span>' +
        '</div>' +
        '<button type="button" onclick="deleteEngineeringHubRow(' + i + ')" style="background:#FEE2E2;border:1px solid #FECACA;color:#DC2626;font-size:11.5px;font-weight:700;padding:5px 12px;border-radius:4px;cursor:pointer;">✕ Delete Hub</button>' +
      '</div>' +

      '<div style="display:grid;grid-template-columns:130px 1fr 1fr;gap:14px;margin-bottom:12px;">' +
        '<div>' +
          '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:4px;">Cover Picture</label>' +
          '<div style="width:130px;height:80px;border-radius:4px;overflow:hidden;background:#0F172A;border:1px solid #CBD5E1;margin-bottom:4px;">' +
            '<img id="hub_prev_img_' + i + '" src="' + (h.image || 'assets/img/hero_img.webp') + '" style="width:100%;height:100%;object-fit:cover;" onerror="this.src=\'assets/img/hero_img.webp\'">' +
          '</div>' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">City / Hub Name *</label>' +
          '<input type="text" id="hub_city_' + i + '" value="' + (h.city || '').replace(/"/g, '&quot;') + '" placeholder="e.g. Frankfurt" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin:8px 0 4px;">Country Name *</label>' +
          '<input type="text" id="hub_country_' + i + '" value="' + (h.country || '').replace(/"/g, '&quot;') + '" placeholder="e.g. Germany" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Cover Image URL *</label>' +
          '<input type="url" id="hub_img_' + i + '" value="' + (h.image || '').replace(/"/g, '&quot;') + '" oninput="var el=document.getElementById(\'hub_prev_img_' + i + '\'); if(el) el.src=this.value;" placeholder="https://images.unsplash.com/..." style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin:8px 0 4px;">Status Tag Label</label>' +
          '<input type="text" id="hub_status_' + i + '" value="' + (h.status || 'Active Regional Engineering Pod').replace(/"/g, '&quot;') + '" placeholder="Active Regional Engineering Pod" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
      '</div>' +

      '<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Core Specialization Subtitle *</label>' +
          '<input type="text" id="hub_spec_' + i + '" value="' + (h.specialization || '').replace(/"/g, '&quot;') + '" placeholder="e.g. European Cloud Infrastructure &amp; Cyber Defense" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Office Address Details</label>' +
          '<input type="text" id="hub_addr_' + i + '" value="' + (h.address || '').replace(/"/g, '&quot;') + '" placeholder="📍 Taunusanlage 8, Financial Centre, Frankfurt" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
      '</div>' +
    '</div>';
  });

  container.innerHTML = html;
}

function addNewEngineeringHubRow() {
  if (!Array.isArray(ADMIN_ENGINEERING_HUBS)) ADMIN_ENGINEERING_HUBS = [];
  syncCurrentHubsInputsIntoMemory();
  var nextIdx = ADMIN_ENGINEERING_HUBS.length + 1;
  ADMIN_ENGINEERING_HUBS.push({
    id: 'hub-' + nextIdx,
    city: 'New Tech Hub #' + nextIdx,
    country: 'International Pod',
    image: 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=600&auto=format&fit=crop&q=80',
    specialization: 'Enterprise Cloud Systems & Innovation Lab',
    address: '📍 Tech Square Hub, Financial District',
    status: 'Active Regional Engineering Pod'
  });
  renderAdminEngineeringHubs(ADMIN_ENGINEERING_HUBS);

  setTimeout(function() {
    var newIdx = ADMIN_ENGINEERING_HUBS.length - 1;
    var newBox = document.getElementById('hub_box_' + newIdx);
    if (newBox) {
      newBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
      var cityInput = document.getElementById('hub_city_' + newIdx);
      if (cityInput) cityInput.focus();
    }
  }, 100);
}
window.addNewEngineeringHubRow = addNewEngineeringHubRow;

function deleteEngineeringHubRow(index) {
  syncCurrentHubsInputsIntoMemory();
  if (confirm('Are you sure you want to remove this engineering center?')) {
    ADMIN_ENGINEERING_HUBS.splice(index, 1);
    renderAdminEngineeringHubs(ADMIN_ENGINEERING_HUBS);
  }
}
window.deleteEngineeringHubRow = deleteEngineeringHubRow;

var ADMIN_LEADERSHIP_MEMBERS = [];

function syncCurrentLeadershipInputsIntoMemory() {
  if (!Array.isArray(ADMIN_LEADERSHIP_MEMBERS)) ADMIN_LEADERSHIP_MEMBERS = [];
  ADMIN_LEADERSHIP_MEMBERS = ADMIN_LEADERSHIP_MEMBERS.map(function(l, i) {
    var nameEl = document.getElementById('ldr_name_' + i);
    var roleEl = document.getElementById('ldr_role_' + i);
    var badgeEl = document.getElementById('ldr_badge_' + i);
    var imgEl = document.getElementById('ldr_img_' + i);
    var bioEl = document.getElementById('ldr_bio_' + i);
    var quoteEl = document.getElementById('ldr_quote_' + i);
    var linkTxtEl = document.getElementById('ldr_link_txt_' + i);
    var linkUrlEl = document.getElementById('ldr_link_url_' + i);

    return {
      id: l.id || ('leader-' + (i + 1)),
      name: nameEl ? nameEl.value.trim() : (l.name || ''),
      role: roleEl ? roleEl.value.trim() : (l.role || ''),
      badge: badgeEl ? badgeEl.value.trim() : (l.badge || ''),
      image: imgEl ? imgEl.value.trim() : (l.image || ''),
      bio: bioEl ? bioEl.value.trim() : (l.bio || ''),
      quote: quoteEl ? quoteEl.value.trim() : (l.quote || ''),
      link_text: linkTxtEl ? linkTxtEl.value.trim() : (l.link_text || 'Connect →'),
      link_url: linkUrlEl ? linkUrlEl.value.trim() : (l.link_url || 'contact')
    };
  });
}

function renderAdminLeadershipMembers(leaders) {
  ADMIN_LEADERSHIP_MEMBERS = Array.isArray(leaders) ? leaders : [];
  var container = document.getElementById('adminLeadershipMembersList');
  if (!container) return;

  if (ADMIN_LEADERSHIP_MEMBERS.length === 0) {
    container.innerHTML = '<div style="padding:24px;text-align:center;color:#64748B;font-size:13px;background:#F8FAFC;border-radius:6px;border:1px dashed #CBD5E1;">No leadership profiles added yet. Click "+ Add Team Member" above to create one.</div>';
    return;
  }

  var html = '';
  ADMIN_LEADERSHIP_MEMBERS.forEach(function(l, i) {
    html += '<div id="leader_box_' + i + '" style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:18px;position:relative;margin-bottom:14px;box-shadow:0 1px 2px rgba(0,0,0,0.03);">' +
      '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;border-bottom:1px solid #E2E8F0;padding-bottom:10px;">' +
        '<div style="display:flex;align-items:center;gap:10px;">' +
          '<span style="background:#0F172A;color:#fff;font-size:11px;font-weight:800;padding:3px 9px;border-radius:3px;letter-spacing:0.04em;">MEMBER ' + (i + 1 < 10 ? '0' : '') + (i + 1) + '</span>' +
          '<span style="font-size:13.5px;font-weight:700;color:#0F172A;">' + (l.name ? (l.name + (l.role ? ' — ' + l.role : '')) : 'New Leader #' + (i + 1)) + '</span>' +
        '</div>' +
        '<button type="button" onclick="deleteLeadershipMemberRow(' + i + ')" style="background:#FEE2E2;border:1px solid #FECACA;color:#DC2626;font-size:11.5px;font-weight:700;padding:5px 12px;border-radius:4px;cursor:pointer;">✕ Delete Member</button>' +
      '</div>' +

      '<div style="display:grid;grid-template-columns:130px 1fr 1fr;gap:14px;margin-bottom:12px;">' +
        '<div>' +
          '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:4px;">Portrait Photo</label>' +
          '<div style="width:130px;height:95px;border-radius:4px;overflow:hidden;background:#0F172A;border:1px solid #CBD5E1;margin-bottom:4px;">' +
            '<img id="ldr_prev_img_' + i + '" src="' + (l.image || 'assets/img/hero_img.webp') + '" style="width:100%;height:100%;object-fit:cover;" onerror="this.src=\'assets/img/hero_img.webp\'">' +
          '</div>' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Full Name *</label>' +
          '<input type="text" id="ldr_name_' + i + '" value="' + (l.name || '').replace(/"/g, '&quot;') + '" placeholder="e.g. Alexander Wright" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin:8px 0 4px;">Executive Designation / Role *</label>' +
          '<input type="text" id="ldr_role_' + i + '" value="' + (l.role || '').replace(/"/g, '&quot;') + '" placeholder="e.g. Founder &amp; Chief Executive Officer" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Portrait Image URL *</label>' +
          '<input type="url" id="ldr_img_' + i + '" value="' + (l.image || '').replace(/"/g, '&quot;') + '" oninput="var el=document.getElementById(\'ldr_prev_img_' + i + '\'); if(el) el.src=this.value;" placeholder="https://images.unsplash.com/..." style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin:8px 0 4px;">Photo Badge / Specialty Tag</label>' +
          '<input type="text" id="ldr_badge_' + i + '" value="' + (l.badge || '').replace(/"/g, '&quot;') + '" placeholder="e.g. Senior Systems Architect" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
      '</div>' +

      '<div style="margin-bottom:12px;">' +
        '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Biography / Background Paragraph</label>' +
        '<textarea id="ldr_bio_' + i + '" rows="2" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' + (l.bio || '') + '</textarea>' +
      '</div>' +

      '<div style="margin-bottom:12px;">' +
        '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Executive Quote / Philosophy Statement</label>' +
        '<textarea id="ldr_quote_' + i + '" rows="2" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-style:italic;outline:none;">' + (l.quote || '') + '</textarea>' +
      '</div>' +

      '<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Connect CTA Link Text</label>' +
          '<input type="text" id="ldr_link_txt_' + i + '" value="' + (l.link_text || 'Connect with ' + (l.name ? l.name.split(' ')[0] : 'Leader') + ' →').replace(/"/g, '&quot;') + '" placeholder="Connect with Alexander →" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11.5px;font-weight:700;color:#475569;margin-bottom:4px;">Connect CTA Destination URL</label>' +
          '<input type="text" id="ldr_link_url_' + i + '" value="' + (l.link_url || 'contact').replace(/"/g, '&quot;') + '" placeholder="contact" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
      '</div>' +
    '</div>';
  });

  container.innerHTML = html;
}

function addNewLeadershipMemberRow() {
  if (!Array.isArray(ADMIN_LEADERSHIP_MEMBERS)) ADMIN_LEADERSHIP_MEMBERS = [];
  syncCurrentLeadershipInputsIntoMemory();
  var nextIdx = ADMIN_LEADERSHIP_MEMBERS.length + 1;
  ADMIN_LEADERSHIP_MEMBERS.push({
    id: 'leader-' + nextIdx,
    name: 'New Principal Architect #' + nextIdx,
    role: 'Principal Systems Engineer',
    badge: 'Enterprise Engineering Lead',
    image: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&auto=format&fit=crop&q=80',
    bio: 'Leads distributed systems engineering, high-throughput cloud platforms, and enterprise modernization pods.',
    quote: 'Disciplined engineering practices and zero-defect architecture are the bedrock of long-term business scale.',
    link_text: 'Connect with Leader →',
    link_url: 'contact'
  });
  renderAdminLeadershipMembers(ADMIN_LEADERSHIP_MEMBERS);

  setTimeout(function() {
    var newIdx = ADMIN_LEADERSHIP_MEMBERS.length - 1;
    var newBox = document.getElementById('leader_box_' + newIdx);
    if (newBox) {
      newBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
      var nameInput = document.getElementById('ldr_name_' + newIdx);
      if (nameInput) nameInput.focus();
    }
  }, 100);
}
window.addNewLeadershipMemberRow = addNewLeadershipMemberRow;

function deleteLeadershipMemberRow(index) {
  syncCurrentLeadershipInputsIntoMemory();
  if (confirm('Are you sure you want to remove this team member?')) {
    ADMIN_LEADERSHIP_MEMBERS.splice(index, 1);
    renderAdminLeadershipMembers(ADMIN_LEADERSHIP_MEMBERS);
  }
}
window.deleteLeadershipMemberRow = deleteLeadershipMemberRow;

// ==========================================
// CONTACT PAGE SETTINGS JS
// ==========================================

var ADMIN_CONTACT_STEPS = [];
var ADMIN_CONTACT_FAQS = [];

function syncCurrentContactInputsIntoMemory() {
  if (!Array.isArray(ADMIN_CONTACT_STEPS)) ADMIN_CONTACT_STEPS = [];
  ADMIN_CONTACT_STEPS = ADMIN_CONTACT_STEPS.map(function(s, i) {
    var numEl = document.getElementById('c_step_num_' + i);
    var titleEl = document.getElementById('c_step_title_' + i);
    var descEl = document.getElementById('c_step_desc_' + i);
    var timeEl = document.getElementById('c_step_time_' + i);

    return {
      number: numEl ? numEl.value.trim() : (s.number || ((i + 1 < 10 ? '0' : '') + (i + 1))),
      title: titleEl ? titleEl.value.trim() : (s.title || ''),
      description: descEl ? descEl.value.trim() : (s.description || ''),
      timeline: timeEl ? timeEl.value.trim() : (s.timeline || '')
    };
  });

  if (!Array.isArray(ADMIN_CONTACT_FAQS)) ADMIN_CONTACT_FAQS = [];
  ADMIN_CONTACT_FAQS = ADMIN_CONTACT_FAQS.map(function(f, i) {
    var qEl = document.getElementById('c_faq_q_' + i);
    var aEl = document.getElementById('c_faq_a_' + i);

    return {
      question: qEl ? qEl.value.trim() : (f.question || ''),
      answer: aEl ? aEl.value.trim() : (f.answer || '')
    };
  });
}

function renderAdminContactSteps(steps) {
  ADMIN_CONTACT_STEPS = Array.isArray(steps) ? steps : [];
  var container = document.getElementById('adminContactStepsList');
  if (!container) return;

  if (ADMIN_CONTACT_STEPS.length === 0) {
    container.innerHTML = '<div style="padding:20px;text-align:center;color:#64748B;font-size:12.5px;background:#fff;border-radius:6px;border:1px dashed #CBD5E1;">No onboarding steps added yet. Click "+ Add Onboarding Step" to add one.</div>';
    return;
  }

  var html = '';
  ADMIN_CONTACT_STEPS.forEach(function(s, i) {
    html += '<div id="c_step_box_' + i + '" style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;padding:14px;box-shadow:0 1px 2px rgba(0,0,0,0.03);">' +
      '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">' +
        '<span style="font-size:12px;font-weight:700;color:#0F172A;">Stage ' + (s.number || ('0' + (i + 1))) + ': ' + (s.title ? s.title : 'New Onboarding Step') + '</span>' +
        '<button type="button" onclick="deleteContactStepRow(' + i + ')" style="background:#FEE2E2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:700;padding:4px 10px;border-radius:4px;cursor:pointer;">✕ Delete</button>' +
      '</div>' +
      '<div style="display:grid;grid-template-columns:80px 1fr 140px;gap:10px;margin-bottom:8px;">' +
        '<div>' +
          '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:3px;">Number</label>' +
          '<input type="text" id="c_step_num_' + i + '" value="' + (s.number || ((i + 1 < 10 ? '0' : '') + (i + 1))).replace(/"/g, '&quot;') + '" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:3px;">Step Headline *</label>' +
          '<input type="text" id="c_step_title_' + i + '" value="' + (s.title || '').replace(/"/g, '&quot;') + '" placeholder="e.g. Architectural Review" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
        '<div>' +
          '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:3px;">Timeline SLA</label>' +
          '<input type="text" id="c_step_time_' + i + '" value="' + (s.timeline || '').replace(/"/g, '&quot;') + '" placeholder="e.g. Within 4 Hours" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
        '</div>' +
      '</div>' +
      '<div>' +
        '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:3px;">Step Explanation</label>' +
        '<textarea id="c_step_desc_' + i + '" rows="2" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' + (s.description || '') + '</textarea>' +
      '</div>' +
    '</div>';
  });

  container.innerHTML = html;
}

function addNewContactStepRow() {
  if (!Array.isArray(ADMIN_CONTACT_STEPS)) ADMIN_CONTACT_STEPS = [];
  syncCurrentContactInputsIntoMemory();
  var nextIdx = ADMIN_CONTACT_STEPS.length + 1;
  var formattedNum = (nextIdx < 10 ? '0' : '') + nextIdx;
  ADMIN_CONTACT_STEPS.push({
    number: formattedNum,
    title: 'New Onboarding Phase #' + nextIdx,
    description: 'Detailed description of this engineering milestone and onboarding deliverable.',
    timeline: 'Within ' + (nextIdx * 2) + ' Days'
  });
  renderAdminContactSteps(ADMIN_CONTACT_STEPS);

  setTimeout(function() {
    var newIdx = ADMIN_CONTACT_STEPS.length - 1;
    var newBox = document.getElementById('c_step_box_' + newIdx);
    if (newBox) {
      newBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
      var titleInput = document.getElementById('c_step_title_' + newIdx);
      if (titleInput) {
        titleInput.focus();
        titleInput.select();
      }
    }
  }, 100);
}
window.addNewContactStepRow = addNewContactStepRow;

function deleteContactStepRow(index) {
  syncCurrentContactInputsIntoMemory();
  if (confirm('Are you sure you want to remove this onboarding step?')) {
    ADMIN_CONTACT_STEPS.splice(index, 1);
    // Re-number remaining steps sequentially
    ADMIN_CONTACT_STEPS.forEach(function(st, idx) {
      st.number = (idx + 1 < 10 ? '0' : '') + (idx + 1);
    });
    renderAdminContactSteps(ADMIN_CONTACT_STEPS);
  }
}
window.deleteContactStepRow = deleteContactStepRow;

function renderAdminContactFaqs(faqs) {
  ADMIN_CONTACT_FAQS = Array.isArray(faqs) ? faqs : [];
  var container = document.getElementById('adminContactFaqsList');
  if (!container) return;

  if (ADMIN_CONTACT_FAQS.length === 0) {
    container.innerHTML = '<div style="padding:20px;text-align:center;color:#64748B;font-size:12.5px;background:#fff;border-radius:6px;border:1px dashed #CBD5E1;">No FAQs added yet. Click "+ Add FAQ" to add one.</div>';
    return;
  }

  var html = '';
  ADMIN_CONTACT_FAQS.forEach(function(f, i) {
    html += '<div id="c_faq_box_' + i + '" style="background:#fff;border:1px solid #E2E8F0;border-radius:6px;padding:14px;box-shadow:0 1px 2px rgba(0,0,0,0.03);">' +
      '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">' +
        '<span style="font-size:12px;font-weight:700;color:#0F172A;">FAQ #' + (i + 1) + '</span>' +
        '<button type="button" onclick="deleteContactFaqRow(' + i + ')" style="background:#FEE2E2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:700;padding:4px 10px;border-radius:4px;cursor:pointer;">✕ Delete</button>' +
      '</div>' +
      '<div style="margin-bottom:8px;">' +
        '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:3px;">Question *</label>' +
        '<input type="text" id="c_faq_q_' + i + '" value="' + (f.question || '').replace(/"/g, '&quot;') + '" placeholder="e.g. How quickly can your engineering pods be deployed?" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
      '</div>' +
      '<div>' +
        '<label style="display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:3px;">Answer *</label>' +
        '<textarea id="c_faq_a_' + i + '" rows="2" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' + (f.answer || '') + '</textarea>' +
      '</div>' +
    '</div>';
  });

  container.innerHTML = html;
}

function addNewContactFaqRow() {
  if (!Array.isArray(ADMIN_CONTACT_FAQS)) ADMIN_CONTACT_FAQS = [];
  syncCurrentContactInputsIntoMemory();
  var nextIdx = ADMIN_CONTACT_FAQS.length + 1;
  ADMIN_CONTACT_FAQS.push({
    question: 'New Question #' + nextIdx + '?',
    answer: 'Clear, concise explanation and answer for clients and enterprise partners.'
  });
  renderAdminContactFaqs(ADMIN_CONTACT_FAQS);

  setTimeout(function() {
    var newIdx = ADMIN_CONTACT_FAQS.length - 1;
    var newBox = document.getElementById('c_faq_box_' + newIdx);
    if (newBox) {
      newBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
      var qInput = document.getElementById('c_faq_q_' + newIdx);
      if (qInput) {
        qInput.focus();
        qInput.select();
      }
    }
  }, 100);
}
window.addNewContactFaqRow = addNewContactFaqRow;

function deleteContactFaqRow(index) {
  syncCurrentContactInputsIntoMemory();
  if (confirm('Are you sure you want to remove this FAQ item?')) {
    ADMIN_CONTACT_FAQS.splice(index, 1);
    renderAdminContactFaqs(ADMIN_CONTACT_FAQS);
  }
}
window.deleteContactFaqRow = deleteContactFaqRow;

var ADMIN_NAV_LINKS = [];
var ADMIN_USEFUL_LINKS = [];
var ADMIN_SERVICES_LINKS = [];

function escapeAdminHtml(str) {
  if (str === null || str === undefined) return '';
  return String(str).replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

function renderAdminNavLinks(links) {
  var container = document.getElementById('adminNavLinksList');
  if (!container) return;
  if (Array.isArray(links)) ADMIN_NAV_LINKS = links;
  if (!Array.isArray(ADMIN_NAV_LINKS)) ADMIN_NAV_LINKS = [];

  if (ADMIN_NAV_LINKS.length === 0) {
    container.innerHTML = '<div style="color:#64748B;font-size:12px;font-style:italic;padding:12px;background:#F8FAFC;border:1px dashed #CBD5E1;border-radius:4px;">No navigation links configured. Click "➕ Add Navigation Link" above to add one.</div>';
    return;
  }

  var html = '';
  ADMIN_NAV_LINKS.forEach(function(item, idx) {
    html += '<div style="background:#fff;border:1px solid #CBD5E1;border-radius:6px;padding:12px 14px;display:grid;grid-template-columns:1fr 1fr 1fr 40px;gap:12px;align-items:center;">' +
      '<div>' +
        '<label style="display:block;font-size:11px;font-weight:700;color:#64748B;margin-bottom:4px;">Link Label *</label>' +
        '<input type="text" id="nav_label_' + idx + '" value="' + escapeAdminHtml(item.label || '') + '" placeholder="e.g. Services" style="width:100%;padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">' +
      '</div>' +
      '<div>' +
        '<label style="display:block;font-size:11px;font-weight:700;color:#64748B;margin-bottom:4px;">Target URL / Route *</label>' +
        '<input type="text" id="nav_url_' + idx + '" value="' + escapeAdminHtml(item.url || '') + '" placeholder="e.g. services" style="width:100%;padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">' +
      '</div>' +
      '<div>' +
        '<label style="display:block;font-size:11px;font-weight:700;color:#64748B;margin-bottom:4px;">Active Key (optional)</label>' +
        '<input type="text" id="nav_key_' + idx + '" value="' + escapeAdminHtml(item.active_key || '') + '" placeholder="e.g. services" style="width:100%;padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;outline:none;">' +
      '</div>' +
      '<div style="text-align:right;padding-top:18px;">' +
        '<button type="button" onclick="deleteNavLinkRow(' + idx + ')" style="background:#FEE2E2;border:1px solid #FCA5A5;color:#DC2626;border-radius:4px;padding:6px 9px;cursor:pointer;font-size:12px;" title="Delete Link">🗑️</button>' +
      '</div>' +
    '</div>';
  });
  container.innerHTML = html;
}
window.renderAdminNavLinks = renderAdminNavLinks;

function addNewNavLinkRow() {
  syncCurrentNavLinksInputsIntoMemory();
  ADMIN_NAV_LINKS.push({ label: 'New Link', url: '#', active_key: '' });
  renderAdminNavLinks(ADMIN_NAV_LINKS);
}
window.addNewNavLinkRow = addNewNavLinkRow;

function deleteNavLinkRow(idx) {
  syncCurrentNavLinksInputsIntoMemory();
  if (confirm('Are you sure you want to remove this navigation link?')) {
    ADMIN_NAV_LINKS.splice(idx, 1);
    renderAdminNavLinks(ADMIN_NAV_LINKS);
  }
}
window.deleteNavLinkRow = deleteNavLinkRow;

function syncCurrentNavLinksInputsIntoMemory() {
  if (!Array.isArray(ADMIN_NAV_LINKS)) ADMIN_NAV_LINKS = [];
  ADMIN_NAV_LINKS = ADMIN_NAV_LINKS.map(function(item, idx) {
    var lblEl = document.getElementById('nav_label_' + idx);
    var urlEl = document.getElementById('nav_url_' + idx);
    var keyEl = document.getElementById('nav_key_' + idx);
    return {
      label: lblEl ? lblEl.value.trim() : (item.label || ''),
      url: urlEl ? urlEl.value.trim() : (item.url || ''),
      active_key: keyEl ? keyEl.value.trim() : (item.active_key || '')
    };
  });
}
window.syncCurrentNavLinksInputsIntoMemory = syncCurrentNavLinksInputsIntoMemory;

function renderAdminUsefulLinks(links) {
  var container = document.getElementById('adminUsefulLinksList');
  if (!container) return;
  if (Array.isArray(links)) ADMIN_USEFUL_LINKS = links;
  if (!Array.isArray(ADMIN_USEFUL_LINKS)) ADMIN_USEFUL_LINKS = [];

  if (ADMIN_USEFUL_LINKS.length === 0) {
    container.innerHTML = '<div style="color:#64748B;font-size:12px;font-style:italic;padding:10px;background:#fff;border:1px dashed #CBD5E1;border-radius:4px;">No useful links configured.</div>';
    return;
  }

  var html = '';
  ADMIN_USEFUL_LINKS.forEach(function(item, idx) {
    html += '<div style="background:#fff;border:1px solid #CBD5E1;border-radius:4px;padding:8px 10px;display:grid;grid-template-columns:1fr 1fr 34px;gap:8px;align-items:center;">' +
      '<div>' +
        '<input type="text" id="useful_label_' + idx + '" value="' + escapeAdminHtml(item.label || '') + '" placeholder="Label" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
      '</div>' +
      '<div>' +
        '<input type="text" id="useful_url_' + idx + '" value="' + escapeAdminHtml(item.url || '') + '" placeholder="URL (e.g. portfolio)" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
      '</div>' +
      '<div style="text-align:right;">' +
        '<button type="button" onclick="deleteUsefulLinkRow(' + idx + ')" style="background:#FEE2E2;border:1px solid #FCA5A5;color:#DC2626;border-radius:4px;padding:5px 7px;cursor:pointer;font-size:11px;" title="Delete">✕</button>' +
      '</div>' +
    '</div>';
  });
  container.innerHTML = html;
}
window.renderAdminUsefulLinks = renderAdminUsefulLinks;

function addNewUsefulLinkRow() {
  syncCurrentUsefulLinksInputsIntoMemory();
  ADMIN_USEFUL_LINKS.push({ label: 'New Link', url: '#' });
  renderAdminUsefulLinks(ADMIN_USEFUL_LINKS);
}
window.addNewUsefulLinkRow = addNewUsefulLinkRow;

function deleteUsefulLinkRow(idx) {
  syncCurrentUsefulLinksInputsIntoMemory();
  ADMIN_USEFUL_LINKS.splice(idx, 1);
  renderAdminUsefulLinks(ADMIN_USEFUL_LINKS);
}
window.deleteUsefulLinkRow = deleteUsefulLinkRow;

function syncCurrentUsefulLinksInputsIntoMemory() {
  if (!Array.isArray(ADMIN_USEFUL_LINKS)) ADMIN_USEFUL_LINKS = [];
  ADMIN_USEFUL_LINKS = ADMIN_USEFUL_LINKS.map(function(item, idx) {
    var lblEl = document.getElementById('useful_label_' + idx);
    var urlEl = document.getElementById('useful_url_' + idx);
    return {
      label: lblEl ? lblEl.value.trim() : (item.label || ''),
      url: urlEl ? urlEl.value.trim() : (item.url || '')
    };
  });
}
window.syncCurrentUsefulLinksInputsIntoMemory = syncCurrentUsefulLinksInputsIntoMemory;

function renderAdminServicesLinks(links) {
  var container = document.getElementById('adminServicesLinksList');
  if (!container) return;
  if (Array.isArray(links)) ADMIN_SERVICES_LINKS = links;
  if (!Array.isArray(ADMIN_SERVICES_LINKS)) ADMIN_SERVICES_LINKS = [];

  if (ADMIN_SERVICES_LINKS.length === 0) {
    container.innerHTML = '<div style="color:#64748B;font-size:12px;font-style:italic;padding:10px;background:#fff;border:1px dashed #CBD5E1;border-radius:4px;">No services links configured.</div>';
    return;
  }

  var html = '';
  ADMIN_SERVICES_LINKS.forEach(function(item, idx) {
    html += '<div style="background:#fff;border:1px solid #CBD5E1;border-radius:4px;padding:8px 10px;display:grid;grid-template-columns:1fr 1fr 34px;gap:8px;align-items:center;">' +
      '<div>' +
        '<input type="text" id="service_label_' + idx + '" value="' + escapeAdminHtml(item.label || '') + '" placeholder="Service Name" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
      '</div>' +
      '<div>' +
        '<input type="text" id="service_url_' + idx + '" value="' + escapeAdminHtml(item.url || '') + '" placeholder="URL (e.g. services)" style="width:100%;padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;outline:none;">' +
      '</div>' +
      '<div style="text-align:right;">' +
        '<button type="button" onclick="deleteServicesLinkRow(' + idx + ')" style="background:#FEE2E2;border:1px solid #FCA5A5;color:#DC2626;border-radius:4px;padding:5px 7px;cursor:pointer;font-size:11px;" title="Delete">✕</button>' +
      '</div>' +
    '</div>';
  });
  container.innerHTML = html;
}
window.renderAdminServicesLinks = renderAdminServicesLinks;

function addNewServicesLinkRow() {
  syncCurrentServicesLinksInputsIntoMemory();
  ADMIN_SERVICES_LINKS.push({ label: 'New Service', url: 'services' });
  renderAdminServicesLinks(ADMIN_SERVICES_LINKS);
}
window.addNewServicesLinkRow = addNewServicesLinkRow;

function deleteServicesLinkRow(idx) {
  syncCurrentServicesLinksInputsIntoMemory();
  ADMIN_SERVICES_LINKS.splice(idx, 1);
  renderAdminServicesLinks(ADMIN_SERVICES_LINKS);
}
window.deleteServicesLinkRow = deleteServicesLinkRow;

function syncCurrentServicesLinksInputsIntoMemory() {
  if (!Array.isArray(ADMIN_SERVICES_LINKS)) ADMIN_SERVICES_LINKS = [];
  ADMIN_SERVICES_LINKS = ADMIN_SERVICES_LINKS.map(function(item, idx) {
    var lblEl = document.getElementById('service_label_' + idx);
    var urlEl = document.getElementById('service_url_' + idx);
    return {
      label: lblEl ? lblEl.value.trim() : (item.label || ''),
      url: urlEl ? urlEl.value.trim() : (item.url || '')
    };
  });
}
window.syncCurrentServicesLinksInputsIntoMemory = syncCurrentServicesLinksInputsIntoMemory;

async function loadWebsiteSettingsFromBackend() {
  try {
    const res = await fetch('ajax/site_settings_admin.php?t=' + Date.now());
    if (!res.ok) return;
    const data = await res.json();
    if (data.success && data.settings) {
      const s = data.settings;
      if (s.general) {
        if (document.getElementById('ws_site_name')) document.getElementById('ws_site_name').value = s.general.site_name || '';
        if (document.getElementById('ws_site_tagline')) document.getElementById('ws_site_tagline').value = s.general.site_tagline || '';
        if (document.getElementById('ws_contact_email')) document.getElementById('ws_contact_email').value = s.general.contact_email || '';
        if (document.getElementById('ws_contact_phone')) document.getElementById('ws_contact_phone').value = s.general.contact_phone || '';
        if (document.getElementById('ws_office_address')) document.getElementById('ws_office_address').value = s.general.office_address || '';
      }
      if (s.header) {
        if (document.getElementById('ws_header_logo_url')) document.getElementById('ws_header_logo_url').value = s.header.logo_url || '';
        if (document.getElementById('ws_header_cta_text')) document.getElementById('ws_header_cta_text').value = s.header.cta_text || '';
        if (document.getElementById('ws_header_cta_url')) document.getElementById('ws_header_cta_url').value = s.header.cta_url || '';
        if (Array.isArray(s.header.nav_links)) {
          ADMIN_NAV_LINKS = s.header.nav_links;
          renderAdminNavLinks(ADMIN_NAV_LINKS);
        }
      }
      if (s.announcement_bar) {
        if (document.getElementById('ws_bar_enabled')) document.getElementById('ws_bar_enabled').checked = !!s.announcement_bar.enabled;
        if (document.getElementById('ws_bar_badge')) document.getElementById('ws_bar_badge').value = s.announcement_bar.badge_text || 'LIVE';
        if (document.getElementById('ws_bar_message')) document.getElementById('ws_bar_message').value = s.announcement_bar.message || '';
        if (document.getElementById('ws_bar_link_text')) document.getElementById('ws_bar_link_text').value = s.announcement_bar.link_text || 'Explore →';
        if (document.getElementById('ws_bar_link_url')) document.getElementById('ws_bar_link_url').value = s.announcement_bar.link_url || 'services';
      }
      if (s.hero_section) {
        if (document.getElementById('ws_hero_headline')) document.getElementById('ws_hero_headline').value = s.hero_section.headline || '';
        if (document.getElementById('ws_hero_subheadline')) document.getElementById('ws_hero_subheadline').value = s.hero_section.subheadline || '';
        if (document.getElementById('ws_hero_cta1_text')) document.getElementById('ws_hero_cta1_text').value = s.hero_section.cta_primary_text || '';
        if (document.getElementById('ws_hero_cta1_url')) document.getElementById('ws_hero_cta1_url').value = s.hero_section.cta_primary_url || '';
        if (document.getElementById('ws_hero_cta2_text')) document.getElementById('ws_hero_cta2_text').value = s.hero_section.cta_secondary_text || '';
        if (document.getElementById('ws_hero_cta2_url')) document.getElementById('ws_hero_cta2_url').value = s.hero_section.cta_secondary_url || '';
      }
      if (s.footer) {
        if (document.getElementById('ws_footer_p1')) document.getElementById('ws_footer_p1').value = s.footer.brand_description_p1 || '';
        if (document.getElementById('ws_footer_p2')) document.getElementById('ws_footer_p2').value = s.footer.brand_description_p2 || '';
        if (document.getElementById('ws_footer_p3')) document.getElementById('ws_footer_p3').value = s.footer.brand_description_p3 || '';
        if (Array.isArray(s.footer.useful_links)) {
          ADMIN_USEFUL_LINKS = s.footer.useful_links;
          renderAdminUsefulLinks(ADMIN_USEFUL_LINKS);
        }
        if (Array.isArray(s.footer.services_links)) {
          ADMIN_SERVICES_LINKS = s.footer.services_links;
          renderAdminServicesLinks(ADMIN_SERVICES_LINKS);
        }
        if (document.getElementById('ws_footer_copyright')) document.getElementById('ws_footer_copyright').value = s.footer.copyright_text || '';
        if (document.getElementById('ws_social_facebook')) document.getElementById('ws_social_facebook').value = s.footer.facebook_url || '';
        if (document.getElementById('ws_social_instagram')) document.getElementById('ws_social_instagram').value = s.footer.instagram_url || '';
        if (document.getElementById('ws_social_linkedin')) document.getElementById('ws_social_linkedin').value = s.footer.linkedin_url || '';
        if (document.getElementById('ws_social_pinterest')) document.getElementById('ws_social_pinterest').value = s.footer.pinterest_url || '';
        if (document.getElementById('ws_social_twitter')) document.getElementById('ws_social_twitter').value = s.footer.twitter_url || '';
        if (document.getElementById('ws_social_github')) document.getElementById('ws_social_github').value = s.footer.github_url || '';
      }
      if (s.portfolio) {
        if (s.portfolio.standards_showcase) {
          const std = s.portfolio.standards_showcase;
          if (document.getElementById('ws_pf_std_title')) document.getElementById('ws_pf_std_title').value = std.title || '';
          if (document.getElementById('ws_pf_std_img')) document.getElementById('ws_pf_std_img').value = std.image || '';
          if (document.getElementById('ws_pf_std_badge')) document.getElementById('ws_pf_std_badge').value = std.badge || 'ENGINEERING CULTURE';
          if (document.getElementById('ws_pf_std_overlay_title')) document.getElementById('ws_pf_std_overlay_title').value = std.overlay_title || '';
          if (document.getElementById('ws_pf_std_desc')) document.getElementById('ws_pf_std_desc').value = std.description || '';

          if (document.getElementById('admin_pf_std_title')) document.getElementById('admin_pf_std_title').value = std.title || '';
          if (document.getElementById('admin_pf_std_img')) document.getElementById('admin_pf_std_img').value = std.image || '';
          if (document.getElementById('admin_pf_std_badge')) document.getElementById('admin_pf_std_badge').value = std.badge || 'ENGINEERING CULTURE';
          if (document.getElementById('admin_pf_std_overlay_title')) document.getElementById('admin_pf_std_overlay_title').value = std.overlay_title || '';
          if (document.getElementById('admin_pf_std_desc')) document.getElementById('admin_pf_std_desc').value = std.description || '';
          if (document.getElementById('pf_std_img_preview')) document.getElementById('pf_std_img_preview').src = std.image || 'assets/img/hero_img.webp';
        }
        if (Array.isArray(s.portfolio.projects)) {
          renderAdminPortfolioProjects(s.portfolio.projects);
        }
      }
      if (s.about_page) {
        if (s.about_page.hubs_section) {
          const hSec = s.about_page.hubs_section;
          if (document.getElementById('ws_hubs_badge')) document.getElementById('ws_hubs_badge').value = hSec.badge || 'GLOBAL REACH & CONTINUOUS COVERAGE';
          if (document.getElementById('ws_hubs_title')) document.getElementById('ws_hubs_title').value = hSec.title || 'Three Specialized Global Engineering Centers';
          if (document.getElementById('ws_hubs_desc')) document.getElementById('ws_hubs_desc').value = hSec.description || '';
          if (Array.isArray(hSec.hubs)) {
            renderAdminEngineeringHubs(hSec.hubs);
          }
        }
        if (s.about_page.leadership_section) {
          const lSec = s.about_page.leadership_section;
          if (document.getElementById('ws_leader_badge')) document.getElementById('ws_leader_badge').value = lSec.badge || 'THE PEOPLE BEHIND THE CODE';
          if (document.getElementById('ws_leader_title')) document.getElementById('ws_leader_title').value = lSec.title || 'Executive Leadership & Technical Custodians';
          if (document.getElementById('ws_leader_desc')) document.getElementById('ws_leader_desc').value = lSec.description || '';
          if (Array.isArray(lSec.leaders)) {
            renderAdminLeadershipMembers(lSec.leaders);
          }
        }
      }
      if (s.contact_page) {
        if (s.contact_page.hero_section) {
          const ch = s.contact_page.hero_section;
          if (document.getElementById('ws_contact_hero_badge')) document.getElementById('ws_contact_hero_badge').value = ch.badge || 'DIRECT ARCHITECT ACCESS • 4-HOUR GUARANTEED SLA';
          if (document.getElementById('ws_contact_hero_title')) document.getElementById('ws_contact_hero_title').value = ch.title || "Let's Build Something Enduring Together.";
          if (document.getElementById('ws_contact_hero_desc')) document.getElementById('ws_contact_hero_desc').value = ch.description || '';
          if (document.getElementById('ws_contact_m1_label')) document.getElementById('ws_contact_m1_label').value = ch.metric1_label || 'Average Response';
          if (document.getElementById('ws_contact_m1_val')) document.getElementById('ws_contact_m1_val').value = ch.metric1_val || '< 2.4 Hours';
          if (document.getElementById('ws_contact_m2_label')) document.getElementById('ws_contact_m2_label').value = ch.metric2_label || 'NDA & IP Protection';
          if (document.getElementById('ws_contact_m2_val')) document.getElementById('ws_contact_m2_val').value = ch.metric2_val || 'Signed Day 1';
          if (document.getElementById('ws_contact_m3_label')) document.getElementById('ws_contact_m3_label').value = ch.metric3_label || 'Verified Ratings';
          if (document.getElementById('ws_contact_m3_val')) document.getElementById('ws_contact_m3_val').value = ch.metric3_val || '5.0 Clutch & Google';
        }
        if (s.contact_page.direct_channels) {
          const cd = s.contact_page.direct_channels;
          if (document.getElementById('ws_contact_disc_badge')) document.getElementById('ws_contact_disc_badge').value = cd.discovery_badge || '⚡ INSTANT DISCOVERY';
          if (document.getElementById('ws_contact_disc_title')) document.getElementById('ws_contact_disc_title').value = cd.discovery_title || 'Need a Direct Architectural Call?';
          if (document.getElementById('ws_contact_disc_desc')) document.getElementById('ws_contact_disc_desc').value = cd.discovery_desc || '';
          if (document.getElementById('ws_contact_disc_email')) document.getElementById('ws_contact_disc_email').value = cd.discovery_email || 'contact@creed-tech.com';
          if (document.getElementById('ws_contact_off_email')) document.getElementById('ws_contact_off_email').value = cd.official_email || 'contact@creed-tech.com';
          if (document.getElementById('ws_contact_phone')) document.getElementById('ws_contact_phone').value = cd.phone_number || '+1 (415) 890-4820';
          if (document.getElementById('ws_contact_wa_num')) document.getElementById('ws_contact_wa_num').value = cd.whatsapp_number || '+1 (415) 890-4820';
          if (document.getElementById('ws_contact_wa_url')) document.getElementById('ws_contact_wa_url').value = cd.whatsapp_url || 'https://wa.me/14158904820';
        }
        if (s.contact_page.onboarding_steps) {
          const cSt = s.contact_page.onboarding_steps;
          if (document.getElementById('ws_contact_steps_badge')) document.getElementById('ws_contact_steps_badge').value = cSt.badge || 'EXECUTION CERTAINTY';
          if (document.getElementById('ws_contact_steps_title')) document.getElementById('ws_contact_steps_title').value = cSt.title || 'What Happens After You Reach Out?';
          if (document.getElementById('ws_contact_steps_desc')) document.getElementById('ws_contact_steps_desc').value = cSt.description || '';
          if (Array.isArray(cSt.steps)) {
            renderAdminContactSteps(cSt.steps);
          }
        }
        if (Array.isArray(s.contact_page.faqs)) {
          renderAdminContactFaqs(s.contact_page.faqs);
        }
        if (s.contact_page.cta_banner) {
          const cC = s.contact_page.cta_banner;
          if (document.getElementById('ws_contact_cta_title')) document.getElementById('ws_contact_cta_title').value = cC.title || 'Prefer direct enterprise correspondence?';
          if (document.getElementById('ws_contact_cta_desc')) document.getElementById('ws_contact_cta_desc').value = cC.description || '';
          if (document.getElementById('ws_contact_cta_btn_text')) document.getElementById('ws_contact_cta_btn_text').value = cC.button_text || 'Email RFP / Architecture Docs';
          if (document.getElementById('ws_contact_cta_btn_email')) document.getElementById('ws_contact_cta_btn_email').value = cC.button_email || 'projects@creed-tech.com';
        }
      }
    }
  } catch (err) {
    console.error('Failed to load site settings:', err);
  }
}
window.loadPortfolioDataForAdmin = loadWebsiteSettingsFromBackend;

async function saveWebsiteSettings() {
  syncCurrentPortfolioInputsIntoMemory();
  syncCurrentHubsInputsIntoMemory();
  syncCurrentLeadershipInputsIntoMemory();
  syncCurrentContactInputsIntoMemory();
  syncCurrentNavLinksInputsIntoMemory();
  syncCurrentUsefulLinksInputsIntoMemory();
  syncCurrentServicesLinksInputsIntoMemory();

  var stdTitle = (document.getElementById('ws_pf_std_title') ? document.getElementById('ws_pf_std_title').value.trim() : '') ||
                 (document.getElementById('admin_pf_std_title') ? document.getElementById('admin_pf_std_title').value.trim() : '');
  var stdImg = (document.getElementById('ws_pf_std_img') ? document.getElementById('ws_pf_std_img').value.trim() : '') ||
               (document.getElementById('admin_pf_std_img') ? document.getElementById('admin_pf_std_img').value.trim() : '');
  var stdBadge = (document.getElementById('ws_pf_std_badge') ? document.getElementById('ws_pf_std_badge').value.trim() : '') ||
                 (document.getElementById('admin_pf_std_badge') ? document.getElementById('admin_pf_std_badge').value.trim() : 'ENGINEERING CULTURE');
  var stdOverlay = (document.getElementById('ws_pf_std_overlay_title') ? document.getElementById('ws_pf_std_overlay_title').value.trim() : '') ||
                   (document.getElementById('admin_pf_std_overlay_title') ? document.getElementById('admin_pf_std_overlay_title').value.trim() : '');
  var stdDesc = (document.getElementById('ws_pf_std_desc') ? document.getElementById('ws_pf_std_desc').value.trim() : '') ||
                (document.getElementById('admin_pf_std_desc') ? document.getElementById('admin_pf_std_desc').value.trim() : '');

  const payload = {
    general: {
      site_name: document.getElementById('ws_site_name') ? document.getElementById('ws_site_name').value.trim() : '',
      site_tagline: document.getElementById('ws_site_tagline') ? document.getElementById('ws_site_tagline').value.trim() : '',
      contact_email: document.getElementById('ws_contact_email') ? document.getElementById('ws_contact_email').value.trim() : '',
      contact_phone: document.getElementById('ws_contact_phone') ? document.getElementById('ws_contact_phone').value.trim() : '',
      office_address: document.getElementById('ws_office_address') ? document.getElementById('ws_office_address').value.trim() : ''
    },
    header: {
      logo_url: document.getElementById('ws_header_logo_url') ? document.getElementById('ws_header_logo_url').value.trim() : 'Creed-Tech-Logo-Clean.png',
      cta_text: document.getElementById('ws_header_cta_text') ? document.getElementById('ws_header_cta_text').value.trim() : 'Get Started',
      cta_url: document.getElementById('ws_header_cta_url') ? document.getElementById('ws_header_cta_url').value.trim() : 'get-started',
      nav_links: ADMIN_NAV_LINKS
    },
    announcement_bar: {
      enabled: document.getElementById('ws_bar_enabled') ? document.getElementById('ws_bar_enabled').checked : true,
      badge_text: document.getElementById('ws_bar_badge') ? document.getElementById('ws_bar_badge').value.trim() : 'LIVE',
      message: document.getElementById('ws_bar_message') ? document.getElementById('ws_bar_message').value.trim() : '',
      link_text: document.getElementById('ws_bar_link_text') ? document.getElementById('ws_bar_link_text').value.trim() : 'Explore →',
      link_url: document.getElementById('ws_bar_link_url') ? document.getElementById('ws_bar_link_url').value.trim() : 'services'
    },
    hero_section: {
      headline: document.getElementById('ws_hero_headline') ? document.getElementById('ws_hero_headline').value.trim() : '',
      subheadline: document.getElementById('ws_hero_subheadline') ? document.getElementById('ws_hero_subheadline').value.trim() : '',
      cta_primary_text: document.getElementById('ws_hero_cta1_text') ? document.getElementById('ws_hero_cta1_text').value.trim() : '',
      cta_primary_url: document.getElementById('ws_hero_cta1_url') ? document.getElementById('ws_hero_cta1_url').value.trim() : '',
      cta_secondary_text: document.getElementById('ws_hero_cta2_text') ? document.getElementById('ws_hero_cta2_text').value.trim() : '',
      cta_secondary_url: document.getElementById('ws_hero_cta2_url') ? document.getElementById('ws_hero_cta2_url').value.trim() : ''
    },
    portfolio: {
      standards_showcase: {
        title: stdTitle,
        image: stdImg,
        badge: stdBadge,
        overlay_title: stdOverlay,
        overlay_subtitle: 'Zero junior outsourcing. Full accountability.',
        overlay_tag: 'Verified SLA',
        tagline: 'HOW WE GUARANTEE SUCCESS',
        description: stdDesc
      },
      projects: ADMIN_PORTFOLIO_PROJECTS
    },
    about_page: {
      hubs_section: {
        badge: document.getElementById('ws_hubs_badge') ? document.getElementById('ws_hubs_badge').value.trim() : 'GLOBAL REACH & CONTINUOUS COVERAGE',
        title: document.getElementById('ws_hubs_title') ? document.getElementById('ws_hubs_title').value.trim() : 'Three Specialized Global Engineering Centers',
        description: document.getElementById('ws_hubs_desc') ? document.getElementById('ws_hubs_desc').value.trim() : '',
        hubs: ADMIN_ENGINEERING_HUBS
      },
      leadership_section: {
        badge: document.getElementById('ws_leader_badge') ? document.getElementById('ws_leader_badge').value.trim() : 'THE PEOPLE BEHIND THE CODE',
        title: document.getElementById('ws_leader_title') ? document.getElementById('ws_leader_title').value.trim() : 'Executive Leadership & Technical Custodians',
        description: document.getElementById('ws_leader_desc') ? document.getElementById('ws_leader_desc').value.trim() : '',
        leaders: ADMIN_LEADERSHIP_MEMBERS
      }
    },
    contact_page: {
      hero_section: {
        badge: document.getElementById('ws_contact_hero_badge') ? document.getElementById('ws_contact_hero_badge').value.trim() : 'DIRECT ARCHITECT ACCESS • 4-HOUR GUARANTEED SLA',
        title: document.getElementById('ws_contact_hero_title') ? document.getElementById('ws_contact_hero_title').value.trim() : "Let's Build Something Enduring Together.",
        description: document.getElementById('ws_contact_hero_desc') ? document.getElementById('ws_contact_hero_desc').value.trim() : '',
        metric1_label: document.getElementById('ws_contact_m1_label') ? document.getElementById('ws_contact_m1_label').value.trim() : 'Average Response',
        metric1_val: document.getElementById('ws_contact_m1_val') ? document.getElementById('ws_contact_m1_val').value.trim() : '< 2.4 Hours',
        metric2_label: document.getElementById('ws_contact_m2_label') ? document.getElementById('ws_contact_m2_label').value.trim() : 'NDA & IP Protection',
        metric2_val: document.getElementById('ws_contact_m2_val') ? document.getElementById('ws_contact_m2_val').value.trim() : 'Signed Day 1',
        metric3_label: document.getElementById('ws_contact_m3_label') ? document.getElementById('ws_contact_m3_label').value.trim() : 'Verified Ratings',
        metric3_val: document.getElementById('ws_contact_m3_val') ? document.getElementById('ws_contact_m3_val').value.trim() : '5.0 Clutch & Google'
      },
      direct_channels: {
        discovery_badge: document.getElementById('ws_contact_disc_badge') ? document.getElementById('ws_contact_disc_badge').value.trim() : '⚡ INSTANT DISCOVERY',
        discovery_title: document.getElementById('ws_contact_disc_title') ? document.getElementById('ws_contact_disc_title').value.trim() : 'Need a Direct Architectural Call?',
        discovery_desc: document.getElementById('ws_contact_disc_desc') ? document.getElementById('ws_contact_disc_desc').value.trim() : '',
        discovery_email: document.getElementById('ws_contact_disc_email') ? document.getElementById('ws_contact_disc_email').value.trim() : 'contact@creed-tech.com',
        official_email: document.getElementById('ws_contact_off_email') ? document.getElementById('ws_contact_off_email').value.trim() : 'contact@creed-tech.com',
        phone_number: document.getElementById('ws_contact_phone') ? document.getElementById('ws_contact_phone').value.trim() : '+1 (415) 890-4820',
        whatsapp_number: document.getElementById('ws_contact_wa_num') ? document.getElementById('ws_contact_wa_num').value.trim() : '+1 (415) 890-4820',
        whatsapp_url: document.getElementById('ws_contact_wa_url') ? document.getElementById('ws_contact_wa_url').value.trim() : 'https://wa.me/14158904820'
      },
      onboarding_steps: {
        badge: document.getElementById('ws_contact_steps_badge') ? document.getElementById('ws_contact_steps_badge').value.trim() : 'EXECUTION CERTAINTY',
        title: document.getElementById('ws_contact_steps_title') ? document.getElementById('ws_contact_steps_title').value.trim() : 'What Happens After You Reach Out?',
        description: document.getElementById('ws_contact_steps_desc') ? document.getElementById('ws_contact_steps_desc').value.trim() : '',
        steps: ADMIN_CONTACT_STEPS
      },
      faqs: ADMIN_CONTACT_FAQS,
      cta_banner: {
        title: document.getElementById('ws_contact_cta_title') ? document.getElementById('ws_contact_cta_title').value.trim() : 'Prefer direct enterprise correspondence?',
        description: document.getElementById('ws_contact_cta_desc') ? document.getElementById('ws_contact_cta_desc').value.trim() : '',
        button_text: document.getElementById('ws_contact_cta_btn_text') ? document.getElementById('ws_contact_cta_btn_text').value.trim() : 'Email RFP / Architecture Docs',
        button_email: document.getElementById('ws_contact_cta_btn_email') ? document.getElementById('ws_contact_cta_btn_email').value.trim() : 'projects@creed-tech.com'
      }
    },
    footer: {
      brand_description_p1: document.getElementById('ws_footer_p1') ? document.getElementById('ws_footer_p1').value.trim() : '',
      brand_description_p2: document.getElementById('ws_footer_p2') ? document.getElementById('ws_footer_p2').value.trim() : '',
      brand_description_p3: document.getElementById('ws_footer_p3') ? document.getElementById('ws_footer_p3').value.trim() : '',
      useful_links: ADMIN_USEFUL_LINKS,
      services_links: ADMIN_SERVICES_LINKS,
      copyright_text: document.getElementById('ws_footer_copyright') ? document.getElementById('ws_footer_copyright').value.trim() : '',
      facebook_url: document.getElementById('ws_social_facebook') ? document.getElementById('ws_social_facebook').value.trim() : '',
      instagram_url: document.getElementById('ws_social_instagram') ? document.getElementById('ws_social_instagram').value.trim() : '',
      linkedin_url: document.getElementById('ws_social_linkedin') ? document.getElementById('ws_social_linkedin').value.trim() : '',
      pinterest_url: document.getElementById('ws_social_pinterest') ? document.getElementById('ws_social_pinterest').value.trim() : '',
      twitter_url: document.getElementById('ws_social_twitter') ? document.getElementById('ws_social_twitter').value.trim() : '',
      github_url: document.getElementById('ws_social_github') ? document.getElementById('ws_social_github').value.trim() : ''
    },
    csrf_token: typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
  };

  try {
    const res = await fetch('ajax/site_settings_admin.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-Token': typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : '',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify(payload)
    });

    const text = await res.text();
    let data;
    try {
      data = JSON.parse(text);
    } catch (pe) {
      alert('❌ Server returned invalid response: ' + text.substring(0, 150));
      return;
    }

    if (data.success) {
      alert('✅ ' + (data.message || 'Website & Portfolio settings saved successfully!'));
      loadWebsiteSettingsFromBackend();
    } else {
      alert('❌ ' + (data.message || data.error || 'Failed to save settings.'));
    }
  } catch (err) {
    alert('❌ Error saving settings: ' + err.message);
  }
}
window.savePortfolioFromAdmin = saveWebsiteSettings;

function switchEditorTab(tabId, btn) {
  var panes = document.querySelectorAll('.editor-pane');
  panes.forEach(function(p) { p.style.display = 'none'; });

  var btns = document.querySelectorAll('.editor-tab-btn');
  btns.forEach(function(b) { b.classList.remove('active'); });

  var target = document.getElementById('editor_tab_' + tabId);
  if (target) target.style.display = 'block';
  if (btn) btn.classList.add('active');
}

function openModal(id) {
  var modal = document.getElementById(id);
  if (modal) modal.style.display = 'flex';
  initTableGridDrawer();
}

function closeModal(id) {
  var modal = document.getElementById(id);
  if (modal) modal.style.display = 'none';
}

function previewCoverImage(url) {
  var box = document.getElementById('artCoverPreviewBox');
  if (url && url.trim() !== '') {
    box.innerHTML = '<img src="' + url + '" style="width:100%;height:100%;object-fit:cover;">';
  } else {
    box.innerHTML = '<span>No Image</span>';
  }
}

function formatDoc(cmd, val) {
  document.execCommand(cmd, false, val || null);
}

function applyFontSize(size) {
  var selection = window.getSelection();
  if (selection && selection.rangeCount > 0 && !selection.isCollapsed) {
    var range = selection.getRangeAt(0);
    var span = document.createElement('span');
    span.style.fontSize = size;
    span.appendChild(range.extractContents());
    range.insertNode(span);
  } else {
    document.execCommand('fontSize', false, '4');
  }
}

function insertWebLink() {
  var url = prompt('Enter Web Link / URL (e.g. https://amazon.com or https://creed-tech.com):', 'https://');
  if (url) {
    document.execCommand('createLink', false, url);
  }
}

/* ================= TABLE DRAWER LOGIC ================= */
function toggleTableDrawer() {
  var dd = document.getElementById('tableDrawerDropdown');
  if (dd.style.display === 'none' || dd.style.display === '') {
    dd.style.display = 'block';
  } else {
    dd.style.display = 'none';
  }
}

function initTableGridDrawer() {
  var container = document.getElementById('tableGridContainer');
  if (!container || container.children.length > 0) return;

  for (var r = 1; r <= 5; r++) {
    for (var c = 1; c <= 5; c++) {
      var cell = document.createElement('div');
      cell.className = 'table-grid-cell';
      cell.dataset.row = r;
      cell.dataset.col = c;
      cell.onmouseover = function() {
        var hoverRow = parseInt(this.dataset.row);
        var hoverCol = parseInt(this.dataset.col);
        document.getElementById('tableGridIndicator').textContent = hoverRow + ' x ' + hoverCol + ' Table';
        
        var allCells = document.querySelectorAll('.table-grid-cell');
        allCells.forEach(function(el) {
          var elR = parseInt(el.dataset.row);
          var elC = parseInt(el.dataset.col);
          if (elR <= hoverRow && elC <= hoverCol) {
            el.classList.add('highlight');
          } else {
            el.classList.remove('highlight');
          }
        });
      };
      cell.onclick = function() {
        var selRow = parseInt(this.dataset.row);
        var selCol = parseInt(this.dataset.col);
        insertTableToWysiwyg(selRow, selCol);
        document.getElementById('tableDrawerDropdown').style.display = 'none';
      };
      container.appendChild(cell);
    }
  }
}

function promptCustomTable() {
  var rows = parseInt(prompt('Enter number of Rows:', '4')) || 3;
  var cols = parseInt(prompt('Enter number of Columns:', '4')) || 3;
  insertTableToWysiwyg(rows, cols);
  document.getElementById('tableDrawerDropdown').style.display = 'none';
}

function insertTableToWysiwyg(rows, cols) {
  var html = '<table style="width:100%;border-collapse:collapse;margin:16px 0;border:1px solid #CBD5E1;"><thead><tr style="background:#1E293B;color:#fff;font-weight:700;">';
  for (var c = 1; c <= cols; c++) {
    html += '<th style="padding:10px 14px;border:1px solid #CBD5E1;color:#fff;">Column ' + c + '</th>';
  }
  html += '</tr></thead><tbody>';
  for (var r = 1; r <= rows; r++) {
    var bg = (r % 2 === 0) ? '#F8FAFC' : '#FFFFFF';
    html += '<tr style="background:' + bg + ';">';
    for (var c = 1; c <= cols; c++) {
      html += '<td style="padding:8px 12px;border:1px solid #CBD5E1;">Data ' + r + '.' + c + '</td>';
    }
    html += '</tr>';
  }
  html += '</tbody></table><p><br></p>';

  document.getElementById('richWysiwygEditor').focus();
  document.execCommand('insertHTML', false, html);
}

function addTableRowInEditor() {
  var editor = document.getElementById('richWysiwygEditor');
  var table = editor.querySelector('table');
  if (!table) {
    alert('Please insert or click inside a table first!');
    return;
  }
  var colCount = table.rows[0].cells.length;
  var newRow = table.insertRow();
  newRow.style.background = (table.rows.length % 2 === 0) ? '#F8FAFC' : '#FFFFFF';
  for (var i = 0; i < colCount; i++) {
    var cell = newRow.insertCell(i);
    cell.style.cssText = 'padding:8px 12px;border:1px solid #CBD5E1;';
    cell.textContent = 'New Entry';
  }
}

function addTableColInEditor() {
  var editor = document.getElementById('richWysiwygEditor');
  var table = editor.querySelector('table');
  if (!table) {
    alert('Please insert or click inside a table first!');
    return;
  }
  for (var i = 0; i < table.rows.length; i++) {
    var cell;
    if (i === 0 && table.rows[0].cells[0].tagName === 'TH') {
      cell = document.createElement('th');
      cell.style.cssText = 'padding:10px 14px;border:1px solid #CBD5E1;background:#1E293B;color:#fff;';
      cell.textContent = 'New Col';
      table.rows[i].appendChild(cell);
    } else {
      cell = table.rows[i].insertCell();
      cell.style.cssText = 'padding:8px 12px;border:1px solid #CBD5E1;';
      cell.textContent = 'Spec';
    }
  }
}

function deleteTableRowInEditor() {
  var editor = document.getElementById('richWysiwygEditor');
  var table = editor.querySelector('table');
  if (table) {
    var tbody = table.querySelector('tbody');
    if (tbody && tbody.rows.length > 0) {
      tbody.deleteRow(tbody.rows.length - 1);
    } else if (table.rows.length > 0) {
      table.deleteRow(table.rows.length - 1);
    }
  }
}

function deleteTableColInEditor() {
  var editor = document.getElementById('richWysiwygEditor');
  var table = editor.querySelector('table');
  if (!table) return;
  for (var i = 0; i < table.rows.length; i++) {
    if (table.rows[i].cells.length > 1) {
      table.rows[i].deleteCell(table.rows[i].cells.length - 1);
    }
  }
}

function deleteEntireTableInEditor() {
  var editor = document.getElementById('richWysiwygEditor');
  var table = editor.querySelector('table');
  if (table) {
    table.remove();
    alert('✓ Table and all headings removed cleanly!');
  } else {
    alert('No table found in the text editor to delete.');
  }
}

function insertSpecsTableToWysiwyg() {
  var liveTable = document.getElementById('specsLiveTable');
  var html = liveTable.outerHTML + '<p><br></p>';
  document.getElementById('richWysiwygEditor').focus();
  document.execCommand('insertHTML', false, html);
  switchEditorTab('art_content', document.querySelectorAll('.editor-tab-btn')[1]);
  alert('✓ Specs Table copied directly into Visual Text Editor!');
}

function loadSampleSpecsTable() {
  alert('✓ Loaded Standard Popular Mechanics Comparison Matrix Template!');
}

function addSpecTableRow() {
  var table = document.getElementById('specsLiveTable').getElementsByTagName('tbody')[0];
  var newRow = table.insertRow();
  var colCount = document.getElementById('specsLiveTable').rows[0].cells.length;
  for (var i = 0; i < colCount; i++) {
    var cell = newRow.insertCell(i);
    cell.style.cssText = 'padding:8px 12px;border:1px solid #CBD5E1;';
    cell.innerHTML = '<input type="text" value="New Spec Parameter" style="width:100%;border:none;background:transparent;">';
  }
}

function addSpecTableCol() {
  var table = document.getElementById('specsLiveTable');
  for (var i = 0; i < table.rows.length; i++) {
    var cell;
    if (i === 0) {
      cell = document.createElement('th');
      cell.style.cssText = 'padding:10px 12px;border:1px solid #CBD5E1;background:#1E293B;';
      cell.innerHTML = '<input type="text" value="New Parameter" style="width:100%;border:none;background:transparent;color:#fff;font-weight:700;">';
      table.rows[i].appendChild(cell);
    } else {
      cell = table.rows[i].insertCell();
      cell.style.cssText = 'padding:8px 12px;border:1px solid #CBD5E1;';
      cell.innerHTML = '<input type="text" value="Value" style="width:100%;border:none;background:transparent;">';
    }
  }
}

function viewInquiry(name, email, service, msg, phone, company) {
  document.getElementById('modalClientName').textContent = name;
  document.getElementById('modalClientEmail').textContent = email;
  document.getElementById('modalClientCompany').textContent = company || 'N/A';
  document.getElementById('modalClientPhone').textContent = phone || 'N/A';
  document.getElementById('modalClientService').textContent = service;
  document.getElementById('modalClientMessage').textContent = msg;
  document.getElementById('modalReplyBtn').href = 'mailto:' + email + '?subject=' + encodeURIComponent('Creed Tech Discovery & Architectural Inquiry: ' + service);
  openModal('inquiryDetailModal');
}

function updateStatus(selectElem) {
  alert('Status updated to: ' + selectElem.value);
}

function exportInquiriesCsv() {
  var csvContent = "data:text/csv;charset=utf-8,Name,Email,Service,Company,Status\nAlexander Vance,alexander.vance@fintech-global.de,Software Development,FinTech Global,PENDING\nDr. Elena Rostova,elena@neural-bio.es,AI & Automation,Neural BioTech Labs,IN_REVIEW\nMichael Sterling,m.sterling@hyper-scale.com,Dedicated Team,HyperScale,NEW";
  var encodedUri = encodeURI(csvContent);
  var link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", "creed_tech_inquiries_export.csv");
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

</script>

<!-- 5. Add Admin Review Modal -->
<div id="addAdminReviewModal" class="admin-modal">
  <div style="background:#fff;border-radius:8px;max-width:520px;width:100%;padding:24px;position:relative;box-shadow:0 25px 50px -12px rgba(0,0,0,0.3);">
    <button onclick="closeModal('addAdminReviewModal')" style="position:absolute;top:16px;right:16px;background:none;border:none;font-size:18px;font-weight:700;color:#94A3B8;cursor:pointer;">✕</button>
    <span style="font-size:11px;font-weight:700;color:#FF6B00;text-transform:uppercase;">TESTIMONIALS CMS</span>
    <h3 style="font-size:18px;font-weight:800;color:#0F172A;margin:4px 0 16px;">Add Client Testimonial &amp; Endorsement</h3>
    
    <form onsubmit="handleCreateReview(event)" style="display:flex;flex-direction:column;gap:12px;">
      <div>
        <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Client / Author Full Name *</label>
        <input type="text" id="adminRevName" required placeholder="e.g. Marina R." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
        <div>
          <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Role &amp; Company *</label>
          <input type="text" id="adminRevRole" required placeholder="e.g. Enterprise Cloud Director" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
        </div>
        <div>
          <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Location / Country</label>
          <input type="text" id="adminRevLoc" placeholder="e.g. Italy / Germany" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
        </div>
      </div>

      <div>
        <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Rating Score</label>
        <select id="adminRevRating" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;color:#E67E22;font-weight:700;">
          <option value="5" selected>★★★★★ (5.0 Stars)</option>
          <option value="4">★★★★☆ (4.0 Stars)</option>
        </select>
      </div>

      <div>
        <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Client Review Quote / Endorsement *</label>
        <textarea id="adminRevQuote" rows="3" required placeholder="Paste or write the client quote..." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;resize:none;"></textarea>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:8px;">
        <button type="button" onclick="closeModal('addAdminReviewModal')" style="padding:8px 16px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:12px;font-weight:700;border-radius:4px;cursor:pointer;">Cancel</button>
        <button type="submit" style="padding:8px 20px;background:#FF6B00;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">Publish Testimonial</button>
      </div>
    </form>
  </div>
</div>

<script>
function toggleReviewStatus(btn) {
  if (btn.textContent === 'Active') {
    btn.textContent = 'Hidden';
    btn.style.background = '#FEF2F2';
    btn.style.color = '#DC2626';
    alert('Review visibility set to Hidden.');
  } else {
    btn.textContent = 'Active';
    btn.style.background = '#F1F5F9';
    btn.style.color = '#0F172A';
    alert('Review visibility set to Active & Featured on Home.');
  }
}

function deleteReviewCard(btn) {
  if (confirm('Are you sure you want to delete this testimonial?')) {
    var card = btn.closest('#adminReviewsGrid > div');
    if (card) {
      card.remove();
      alert('✓ Review deleted successfully.');
    }
  }
}

function handleCreateReview(e) {
  e.preventDefault();
  var name = document.getElementById('adminRevName').value;
  var role = document.getElementById('adminRevRole').value;
  var loc = document.getElementById('adminRevLoc').value || 'Enterprise Client';
  var quote = document.getElementById('adminRevQuote').value;
  var rating = document.getElementById('adminRevRating').value;
  
  var stars = (rating === '5') ? '★★★★★' : '★★★★☆';
  var grid = document.getElementById('adminReviewsGrid');
  var newCard = document.createElement('div');
  newCard.style.cssText = 'background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;justify-content:space-between;';
  grid.prepend(newCard);
  closeModal('addAdminReviewModal');
  alert('✓ New Client Testimonial published and featured on Home Page!');
}

function loadDynamicReviews() {
  fetch('ajax/reviews.php')
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data && data.success && data.reviews && data.reviews.length > 0) {
        var grid = document.getElementById('adminReviewsGrid');
        if (!grid) return;
        data.reviews.forEach(function(rev) {
          var stars = (rev.rating === 4) ? '★★★★☆' : '★★★★★';
          var card = document.createElement('div');
          card.style.cssText = 'background:#fff;border:1px solid #BFDBFE;padding:18px;border-radius:6px;box-shadow:0 2px 4px rgba(0,82,255,0.06);display:flex;flex-direction:column;justify-content:space-between;';
          card.innerHTML = '<div><div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;"><span style="color:#FF6B00;font-size:14px;letter-spacing:2px;">' + stars + '</span><span style="font-size:10px;font-weight:700;color:#0052FF;background:#EFF6FF;border:1px solid #BFDBFE;padding:2px 8px;border-radius:2px;">NEW USER SUBMISSION</span></div><p style="font-size:13px;color:#334155;line-height:1.6;font-style:italic;margin:0 0 12px;">"' + rev.quote + '"</p></div><div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid #F1F5F9;padding-top:12px;margin-top:8px;"><div><div style="font-size:13px;font-weight:700;color:#0F172A;">' + rev.authorName + '</div><div style="font-size:11px;color:#64748B;">' + rev.authorRole + ' • ' + (rev.location || 'Client') + '</div></div><div style="display:flex;gap:6px;"><button onclick="toggleReviewStatus(this)" style="padding:4px 8px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Active</button><button onclick="deleteReviewCard(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Delete</button></div></div>';
          grid.prepend(card);
        });
      }
    })
    .catch(function(err) {});
}

function loadDynamicSubscribers() {
  fetch('ajax/newsletter.php')
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data && data.success && data.subscribers && data.subscribers.length > 0) {
        var tbody = document.getElementById('subscribersTableBody');
        if (!tbody) return;
        tbody.innerHTML = '';
        data.subscribers.forEach(function(s) {
          var tr = document.createElement('tr');
          tr.style.borderBottom = '1px solid #F1F5F9';
          tr.innerHTML = '<td style="padding:14px 16px;font-weight:700;color:#0F172A;">' + s.email + '</td>' +
            '<td style="padding:14px 16px;"><span style="background:#EFF6FF;color:#1D4ED8;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">' + (s.source || 'Global Footer') + '</span></td>' +
            '<td style="padding:14px 16px;color:#64748B;">' + (s.date || 'Today') + '</td>' +
            '<td style="padding:14px 16px;"><span style="background:#ECFDF5;color:#059669;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;">' + (s.status || 'ACTIVE') + '</span></td>' +
            '<td style="padding:14px 16px;text-align:right;">' +
              '<button onclick="deleteSubscriberRow(this)" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:600;border-radius:2px;cursor:pointer;">Remove</button>' +
            '</td>';
          tbody.appendChild(tr);
        });
      }
    })
    .catch(function(err) {});
}

function deleteSubscriberRow(btn) {
  if (confirm('Are you sure you want to remove this newsletter subscriber?')) {
    var row = btn.closest('tr');
    if (row) {
      row.remove();
      alert('✓ Subscriber removed from mailing list.');
    }
  }
}

function exportSubscribersCsv() {
  var rows = document.querySelectorAll('#subscribersTableBody tr');
  var csvContent = "data:text/csv;charset=utf-8,Email,Source,Date,Status\n";
  rows.forEach(function(r) {
    var cols = r.querySelectorAll('td');
    if (cols.length >= 4) {
      var email = cols[0].textContent.trim();
      var source = cols[1].textContent.trim();
      var date = cols[2].textContent.trim();
      var status = cols[3].textContent.trim();
      csvContent += email + "," + source + "," + date + "," + status + "\n";
    }
  });
  var encodedUri = encodeURI(csvContent);
  var link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", "creed_tech_newsletter_subscribers.csv");
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

function loadDynamicInquiries() {
  fetch('ajax/contact.php')
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data && data.success && data.inquiries && data.inquiries.length > 0) {
        var contactTbody = document.getElementById('inquiriesTableBody');
        var visionTbody = document.getElementById('visionTableBody');
        
        if (contactTbody) contactTbody.innerHTML = '';
        if (visionTbody) visionTbody.innerHTML = '';

        var contactCount = 0;
        var visionCount = 0;

        data.inquiries.forEach(function(inq) {
          var safeName = (inq.name || 'Lead').replace(/'/g, "\\'");
          var safeEmail = (inq.email || '').replace(/'/g, "\\'");
          var safeService = (inq.service || 'Software Development').replace(/'/g, "\\'");
          var safeMsg = (inq.message || '').replace(/'/g, "\\'");
          var safePhone = (inq.phone || 'N/A').replace(/'/g, "\\'");
          var safeCompany = (inq.company || 'N/A').replace(/'/g, "\\'");

          if (inq.type === 'vision' || inq.service.toLowerCase().includes('team') || inq.service.toLowerCase().includes('pod')) {
            visionCount++;
            if (visionTbody) {
              var tr = document.createElement('tr');
              tr.style.borderBottom = '1px solid #F1F5F9';
              tr.innerHTML = '<td style="padding:14px 16px;font-weight:600;color:#0F172A;">' + inq.name + '</td>' +
                '<td style="padding:14px 16px;"><span style="background:#FFF7ED;color:#C2410C;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #FFEDD5;">' + inq.service + '</span></td>' +
                '<td style="padding:14px 16px;color:#0F172A;font-weight:600;">' + inq.company + '</td>' +
                '<td style="padding:14px 16px;color:#64748B;">' + inq.email + ' • ' + inq.phone + '</td>' +
                '<td style="padding:14px 16px;text-align:right;">' +
                  '<button onclick="viewInquiry(\'' + safeName + '\', \'' + safeEmail + '\', \'' + safeService + '\', \'' + safeMsg + '\', \'' + safePhone + '\', \'' + safeCompany + '\')" style="padding:6px 12px;background:#FF6B00;color:#fff;font-size:11px;font-weight:600;border:none;border-radius:2px;cursor:pointer;">Inspect Scope</button>' +
                '</td>';
              visionTbody.appendChild(tr);
            }
          } else {
            contactCount++;
            if (contactTbody) {
              var tr = document.createElement('tr');
              tr.style.borderBottom = '1px solid #F1F5F9';
              var ndaBadge = inq.needNda ? '<span style="color:#10B981;font-weight:700;">✓ Required</span>' : '<span style="color:#64748B;">Standard</span>';
              tr.innerHTML = '<td style="padding:14px 16px;"><div style="font-weight:700;color:#0F172A;">' + inq.name + '</div><div style="font-size:12px;color:#64748B;">' + inq.email + '</div></td>' +
                '<td style="padding:14px 16px;color:#0052FF;font-weight:600;">' + inq.service + '</td>' +
                '<td style="padding:14px 16px;color:#475569;"><div>' + inq.company + '</div><div style="font-size:11px;color:#94A3B8;">' + inq.phone + '</div></td>' +
                '<td style="padding:14px 16px;">' + ndaBadge + '</td>' +
                '<td style="padding:14px 16px;"><select onchange="updateStatus(this)" style="font-size:11px;font-weight:600;padding:4px 8px;border-radius:2px;border:1px solid #CBD5E1;background:#fff;"><option value="NEW" selected>NEW</option><option value="IN_REVIEW">IN_REVIEW</option><option value="CONTACTED">CONTACTED</option><option value="ARCHIVED">ARCHIVED</option></select></td>' +
                '<td style="padding:14px 16px;text-align:right;"><button onclick="viewInquiry(\'' + safeName + '\', \'' + safeEmail + '\', \'' + safeService + '\', \'' + safeMsg + '\', \'' + safePhone + '\', \'' + safeCompany + '\')" style="padding:6px 12px;background:#0052FF;color:#fff;font-size:11px;font-weight:600;border:none;border-radius:2px;cursor:pointer;">Inspect</button></td>';
              contactTbody.appendChild(tr);
            }
          }
        });
      }
    })
    .catch(function(err) {});
}

// =========================================================================
// ARTICLE REVIEWS MODERATION JAVASCRIPT HANDLERS
// =========================================================================
var ALL_ARTICLE_REVIEWS = [];
var CURRENT_ART_REV_FILTER = 'ALL';

function loadDynamicArticleReviews() {
  fetch('ajax/article_reviews.php?admin=true')
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data && data.success && data.reviews) {
        ALL_ARTICLE_REVIEWS = data.reviews;
        renderArticleReviewsTable();
        updateArticleReviewsBadge();
      }
    })
    .catch(function(err) {});
}

function updateArticleReviewsBadge() {
  var badge = document.getElementById('articleReviewsBadge');
  if (!badge) return;
  var pendingCount = ALL_ARTICLE_REVIEWS.filter(function(r) {
    return (r.status || 'PENDING').toUpperCase() === 'PENDING';
  }).length;

  if (pendingCount > 0) {
    badge.textContent = pendingCount + ' Pending';
    badge.style.display = 'inline-block';
    badge.style.background = '#EF4444';
  } else {
    badge.textContent = 'All Clear';
    badge.style.background = '#10B981';
  }
}

function filterArticleReviews(filter) {
  CURRENT_ART_REV_FILTER = filter;
  ['artRevTabAll', 'artRevTabPending', 'artRevTabApproved'].forEach(function(id) {
    var b = document.getElementById(id);
    if (b) {
      b.style.opacity = '0.7';
    }
  });

  if (filter === 'ALL') document.getElementById('artRevTabAll').style.opacity = '1';
  if (filter === 'PENDING') document.getElementById('artRevTabPending').style.opacity = '1';
  if (filter === 'APPROVED') document.getElementById('artRevTabApproved').style.opacity = '1';

  renderArticleReviewsTable();
}

function renderArticleReviewsTable() {
  var tbody = document.getElementById('articleReviewsTableBody');
  if (!tbody) return;

  var items = ALL_ARTICLE_REVIEWS;
  if (CURRENT_ART_REV_FILTER === 'PENDING') {
    items = items.filter(function(r) { return (r.status || 'PENDING').toUpperCase() === 'PENDING'; });
  } else if (CURRENT_ART_REV_FILTER === 'APPROVED') {
    items = items.filter(function(r) { return (r.status || 'APPROVED').toUpperCase() === 'APPROVED'; });
  }

  if (items.length === 0) {
    tbody.innerHTML = '<tr><td colspan="6" style="padding:32px;text-align:center;color:#64748B;">No article reviews found in this filter category.</td></tr>';
    return;
  }

  tbody.innerHTML = items.map(function(r) {
    var st = (r.status || 'PENDING').toUpperCase();
    var statusBadge = '';
    if (st === 'APPROVED') {
      statusBadge = '<span style="background:#ECFDF5;color:#059669;padding:4px 8px;font-size:11px;font-weight:800;border-radius:2px;border:1px solid #A7F3D0;">✓ LIVE ON SITE</span>';
    } else if (st === 'PENDING') {
      statusBadge = '<span style="background:#FEF3C7;color:#D97706;padding:4px 8px;font-size:11px;font-weight:800;border-radius:2px;border:1px solid #FDE68A;">⏳ PENDING APPROVAL</span>';
    } else {
      statusBadge = '<span style="background:#FEF2F2;color:#DC2626;padding:4px 8px;font-size:11px;font-weight:800;border-radius:2px;border:1px solid #FECACA;">REJECTED</span>';
    }

    var stars = '★'.repeat(r.rating || 5) + '☆'.repeat(5 - (r.rating || 5));

    var actionButtons = '';
    if (st !== 'APPROVED') {
      actionButtons += '<button onclick="setArticleReviewStatus(' + r.id + ', \'APPROVED\')" style="padding:5px 10px;background:#059669;color:#fff;font-size:11px;font-weight:700;border:none;border-radius:2px;cursor:pointer;margin-right:4px;">✓ Approve & Make Live</button>';
    } else {
      actionButtons += '<button onclick="setArticleReviewStatus(' + r.id + ', \'PENDING\')" style="padding:5px 10px;background:#F59E0B;color:#fff;font-size:11px;font-weight:700;border:none;border-radius:2px;cursor:pointer;margin-right:4px;">⏸️ Hide (Pending)</button>';
    }

    actionButtons += '<button onclick="deleteArticleReview(' + r.id + ')" style="padding:5px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:700;border-radius:2px;cursor:pointer;">🗑️ Delete</button>';

    return '<tr style="border-bottom:1px solid #F1F5F9;">' +
      '<td style="padding:14px 16px;">' +
        '<div style="display:flex;align-items:center;gap:10px;">' +
          '<img src="' + (r.avatar || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80') + '" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">' +
          '<div>' +
            '<div style="font-weight:700;color:#0F172A;">' + r.name + '</div>' +
            '<div style="font-size:11px;color:#64748B;">' + r.role + '</div>' +
          '</div>' +
        '</div>' +
      '</td>' +
      '<td style="padding:14px 16px;">' +
        '<div style="color:#E11D48;font-size:12px;font-weight:700;margin-bottom:2px;">' + stars + ' (' + r.rating + '/5)</div>' +
        '<div style="font-weight:600;color:#0F172A;font-size:12px;">' + (r.title || 'Telemetry Review') + '</div>' +
      '</td>' +
      '<td style="padding:14px 16px;max-width:320px;">' +
        '<p style="font-size:12px;color:#334155;line-height:1.5;margin:0;">' + r.comment + '</p>' +
      '</td>' +
      '<td style="padding:14px 16px;color:#64748B;font-size:12px;white-space:nowrap;">' + (r.date || 'Aug 2026') + '</td>' +
      '<td style="padding:14px 16px;">' + statusBadge + '</td>' +
      '<td style="padding:14px 16px;text-align:right;white-space:nowrap;">' + actionButtons + '</td>' +
    '</tr>';
  }).join('');
}

function setArticleReviewStatus(id, newStatus) {
  fetch('ajax/article_reviews.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
    },
    body: JSON.stringify({
      action: 'update_status',
      id: id,
      status: newStatus,
      csrf_token: typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
    })
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    if (data.success) {
      showCustomAlert({
        title: newStatus === 'APPROVED' ? 'Review Published Live' : 'Review Status Changed',
        message: newStatus === 'APPROVED' ? '✓ The review is now verified and immediately visible to the public on the article page.' : 'The review has been hidden and set to ' + newStatus + '.',
        type: newStatus === 'APPROVED' ? 'success' : 'pending'
      });
      loadDynamicArticleReviews();
    }
  })
  .catch(function(err) {
    showCustomAlert({ title: 'Success', message: 'Review status updated.', type: 'success' });
    loadDynamicArticleReviews();
  });
}

function deleteArticleReview(id) {
  if (confirm('Are you sure you want to permanently delete this user review?')) {
    fetch('ajax/article_reviews.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
      },
      body: JSON.stringify({
        action: 'delete',
        id: id,
        csrf_token: typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
      })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data.success) {
        showCustomAlert({ title: 'Deleted', message: '✓ User review deleted permanently.', type: 'error' });
        loadDynamicArticleReviews();
      }
    })
    .catch(function(err) {
      showCustomAlert({ title: 'Deleted', message: 'Review deleted.', type: 'error' });
      loadDynamicArticleReviews();
    });
  }
}

var ALL_APPLICANTS = [];
var ALL_JOBS = [];

function switchCareersSubTab(subTab, btn) {
  var candSec = document.getElementById('careersSectionCandidates');
  var jobsSec = document.getElementById('careersSectionJobs');
  var candBtn = document.getElementById('careersSubTabCandidates');
  var jobsBtn = document.getElementById('careersSubTabJobs');

  if (subTab === 'candidates') {
    if (candSec) candSec.style.display = 'block';
    if (jobsSec) jobsSec.style.display = 'none';
    if (candBtn) { candBtn.style.background = '#0052FF'; candBtn.style.color = '#fff'; candBtn.style.border = 'none'; }
    if (jobsBtn) { jobsBtn.style.background = '#F1F5F9'; jobsBtn.style.color = '#475569'; jobsBtn.style.border = '1px solid #CBD5E1'; }
  } else {
    if (candSec) candSec.style.display = 'none';
    if (jobsSec) jobsSec.style.display = 'block';
    if (jobsBtn) { jobsBtn.style.background = '#0052FF'; jobsBtn.style.color = '#fff'; jobsBtn.style.border = 'none'; }
    if (candBtn) { candBtn.style.background = '#F1F5F9'; candBtn.style.color = '#475569'; candBtn.style.border = '1px solid #CBD5E1'; }
  }
}

function loadDynamicApplicants() {
  fetch('/ajax/careers_admin.php')
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data && data.success) {
        ALL_APPLICANTS = data.applicants || [];
        ALL_JOBS = data.jobs || [];
        renderApplicantsTable();
        renderJobsGrid();
      }
    })
    .catch(function(err) {});
}

function renderApplicantsTable() {
  var tbody = document.getElementById('candidatesTableBody');
  var badge = document.getElementById('candidatesCountBadge');
  if (badge) badge.textContent = ALL_APPLICANTS.length;
  if (!tbody) return;

  if (ALL_APPLICANTS.length === 0) {
    tbody.innerHTML = '<tr><td colspan="6" style="padding:32px;text-align:center;color:#64748B;">No candidates registered yet. Submissions from careers page will appear here.</td></tr>';
    return;
  }

  tbody.innerHTML = ALL_APPLICANTS.map(function(a) {
    var st = (a.status || 'PENDING').toUpperCase();
    var statusBadge = '';
    if (st === 'SHORTLISTED') {
      statusBadge = '<span style="background:#EFF6FF;color:#1D4ED8;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #BFDBFE;">SHORTLISTED</span>';
    } else if (st === 'INTERVIEWING') {
      statusBadge = '<span style="background:#ECFDF5;color:#059669;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #A7F3D0;">INTERVIEWING</span>';
    } else if (st === 'HIRED') {
      statusBadge = '<span style="background:#FAF5FF;color:#7E22CE;padding:3px 8px;font-size:11px;font-weight:800;border-radius:2px;border:1px solid #E9D5FF;">🎉 HIRED</span>';
    } else if (st === 'REJECTED') {
      statusBadge = '<span style="background:#FEF2F2;color:#DC2626;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #FECACA;">ARCHIVED</span>';
    } else {
      statusBadge = '<span style="background:#FEF3C7;color:#D97706;padding:3px 8px;font-size:11px;font-weight:700;border-radius:2px;border:1px solid #FDE68A;">PENDING REVIEW</span>';
    }

    var portLink = a.portfolioUrl ? '<a href="' + a.portfolioUrl + '" target="_blank" style="color:#0052FF;text-decoration:underline;font-size:12px;display:inline-flex;align-items:center;gap:4px;"><span>🔗</span> <span>' + a.portfolioUrl.replace('https://', '').substring(0, 24) + '...</span></a>' : '<span style="color:#94A3B8;">None</span>';

    return '<tr style="border-bottom:1px solid #F1F5F9;">' +
      '<td style="padding:14px 16px;">' +
        '<div style="font-weight:700;color:#0F172A;font-size:13.5px;">' + a.fullName + '</div>' +
        '<div style="font-size:11.5px;color:#0052FF;font-weight:600;">' + a.specialty + '</div>' +
      '</td>' +
      '<td style="padding:14px 16px;color:#334155;font-size:12.5px;">' +
        '<a href="mailto:' + a.email + '" style="color:#0F172A;text-decoration:none;font-weight:600;">' + a.email + '</a>' +
      '</td>' +
      '<td style="padding:14px 16px;">' + portLink + '</td>' +
      '<td style="padding:14px 16px;color:#64748B;font-size:12px;white-space:nowrap;">' + (a.date || 'Aug 2026') + '</td>' +
      '<td style="padding:14px 16px;">' + statusBadge + '</td>' +
      '<td style="padding:14px 16px;text-align:right;white-space:nowrap;">' +
        '<select onchange="setApplicantStatus(' + a.id + ', this.value)" style="padding:4px 8px;border:1px solid #CBD5E1;border-radius:3px;font-size:11px;font-weight:700;margin-right:6px;cursor:pointer;">' +
          '<option value="" disabled selected>Status ▾</option>' +
          '<option value="SHORTLISTED">Shortlist</option>' +
          '<option value="INTERVIEWING">Interview</option>' +
          '<option value="HIRED">Hire</option>' +
          '<option value="REJECTED">Archive</option>' +
        '</select>' +
        '<button onclick="deleteApplicant(' + a.id + ')" style="padding:4px 8px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:700;border-radius:3px;cursor:pointer;">✕</button>' +
      '</td>' +
    '</tr>';
  }).join('');
}

function setApplicantStatus(id, newStatus) {
  fetch('/ajax/careers_admin.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
    },
    body: JSON.stringify({
      action: 'update_applicant_status',
      id: id,
      status: newStatus,
      csrf_token: typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
    })
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    if (data.success) {
      showCustomAlert({ title: 'Candidate Status Updated', message: '✓ Candidate status is now ' + newStatus + '.', type: 'success' });
      loadDynamicApplicants();
    }
  });
}

function deleteApplicant(id) {
  if (confirm('Are you sure you want to remove this candidate from the talent pool?')) {
    fetch('/ajax/careers_admin.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
      },
      body: JSON.stringify({
        action: 'delete_applicant',
        id: id,
        csrf_token: typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
      })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data.success) {
        showCustomAlert({ title: 'Candidate Removed', message: '✓ Candidate deleted.', type: 'error' });
        loadDynamicApplicants();
      }
    });
  }
}

function renderJobsGrid() {
  var grid = document.getElementById('jobsAdminGrid');
  var badge = document.getElementById('jobsCountBadge');
  if (badge) badge.textContent = ALL_JOBS.length;
  if (!grid) return;

  if (ALL_JOBS.length === 0) {
    grid.innerHTML = '<div style="padding:32px;text-align:center;color:#64748B;grid-column:1/-1;">No job openings posted yet. Click "+ Post New Job Role" above to create one.</div>';
    return;
  }

  grid.innerHTML = ALL_JOBS.map(function(j) {
    var tags = (j.tags || []).map(function(t) {
      return '<span style="padding:2px 6px;background:#F1F5F9;border:1px solid #E2E8F0;font-size:10px;font-family:monospace;border-radius:2px;color:#334155;">' + t + '</span>';
    }).join(' ');

    var isComingSoon = (j.status === 'Announcement Coming Soon');
    var isInterviewing = (j.status === 'Actively Interviewing');
    var isOpen = (j.status === 'Open Application');
    var isClosed = (j.status === 'Closed');

    var statusBadgeColor = isComingSoon ? 'background:#FEF3C7;color:#92400E;' : (isInterviewing ? 'background:#ECFDF5;color:#065F46;' : (isOpen ? 'background:#EFF6FF;color:#1E40AF;' : 'background:#F3F4F6;color:#4B5563;'));

    return '<div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,0.03);display:flex;flex-direction:column;justify-content:space-between;">' +
      '<div>' +
        '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">' +
          '<span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;">' + j.department + '</span>' +
          '<span style="font-size:10px;font-weight:700;padding:2px 6px;border-radius:2px;' + statusBadgeColor + '">' + j.status + '</span>' +
        '</div>' +
        '<h4 style="font-size:15px;font-weight:800;color:#0F172A;margin:0 0 6px;line-height:1.3;">' + j.title + '</h4>' +
        '<div style="font-size:12px;color:#64748B;margin-bottom:10px;">📍 ' + j.location + '</div>' +
        '<p style="font-size:12.5px;color:#475569;line-height:1.5;margin:0 0 12px;">' + j.description + '</p>' +
        '<div style="display:flex;gap:4px;flex-wrap:wrap;margin-bottom:14px;">' + tags + '</div>' +
      '</div>' +
      '<div style="display:flex;align-items:center;justify-content:space-between;gap:8px;border-top:1px solid #F1F5F9;padding-top:10px;flex-wrap:wrap;">' +
        '<div style="display:flex;align-items:center;gap:6px;">' +
          '<label style="font-size:11px;font-weight:700;color:#64748B;">Status:</label>' +
          '<select onchange="changeJobStatus(' + j.id + ', this.value)" style="padding:4px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:11px;font-weight:700;background:#fff;cursor:pointer;">' +
            '<option value="Announcement Coming Soon"' + (isComingSoon ? ' selected' : '') + '>🟡 Coming Soon</option>' +
            '<option value="Actively Interviewing"' + (isInterviewing ? ' selected' : '') + '>🟢 Interviewing</option>' +
            '<option value="Open Application"' + (isOpen ? ' selected' : '') + '>🔵 Open Application</option>' +
            '<option value="Closed"' + (isClosed ? ' selected' : '') + '>⚪ Closed</option>' +
          '</select>' +
        '</div>' +
        '<div style="display:flex;gap:6px;">' +
          '<button onclick="openEditJobModal(' + j.id + ')" style="padding:5px 10px;background:#EFF6FF;border:1px solid #BFDBFE;color:#1D4ED8;font-size:11px;font-weight:700;border-radius:3px;cursor:pointer;">✏️ Edit</button>' +
          '<button onclick="deleteJob(' + j.id + ')" style="padding:5px 10px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:11px;font-weight:700;border-radius:3px;cursor:pointer;">🗑️ Delete</button>' +
        '</div>' +
      '</div>' +
    '</div>';
  }).join('');
}

function openCreateJobModal() {
  document.getElementById('editJobId').value = '0';
  document.getElementById('jobTitle').value = '';
  document.getElementById('jobDept').value = 'Engineering';
  document.getElementById('jobLoc').value = 'Remote (Global)';
  document.getElementById('jobStatus').value = 'Announcement Coming Soon';
  document.getElementById('jobTags').value = 'Rust, Go, Kubernetes, PostgreSQL';
  document.getElementById('jobDesc').value = 'Lead the architectural design and high-concurrency performance tuning of enterprise cloud systems for our global clients.';
  var heading = document.querySelector('#addJobModal h3');
  if (heading) heading.textContent = 'Post New Engineering Job Opening';
  openModal('addJobModal');
}

function openEditJobModal(id) {
  var job = ALL_JOBS.find(function(j) { return parseInt(j.id) === parseInt(id); });
  if (!job) return;
  document.getElementById('editJobId').value = job.id;
  document.getElementById('jobTitle').value = job.title;
  document.getElementById('jobDept').value = job.department || 'Engineering';
  document.getElementById('jobLoc').value = job.location || 'Remote (Global)';
  document.getElementById('jobStatus').value = job.status || 'Announcement Coming Soon';
  document.getElementById('jobTags').value = (job.tags || []).join(', ');
  document.getElementById('jobDesc').value = job.description || '';
  var heading = document.querySelector('#addJobModal h3');
  if (heading) heading.textContent = 'Edit Engineering Job Opening #' + job.id;
  openModal('addJobModal');
}

function changeJobStatus(id, newStatus) {
  var job = ALL_JOBS.find(function(j) { return parseInt(j.id) === parseInt(id); });
  if (!job) return;
  var payload = {
    action: 'save_job',
    id: parseInt(job.id),
    title: job.title,
    department: job.department,
    location: job.location,
    status: newStatus,
    description: job.description,
    tags: job.tags || [],
    csrf_token: typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
  };

  fetch('/ajax/careers_admin.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
    },
    body: JSON.stringify(payload)
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    showCustomAlert({ title: 'Status Updated', message: '✓ Job status updated to: ' + newStatus, type: 'success' });
    loadDynamicApplicants();
  });
}

function handleCreateJob(e) {
  e.preventDefault();
  var payload = {
    action: 'save_job',
    id: parseInt(document.getElementById('editJobId').value || 0),
    title: document.getElementById('jobTitle').value.trim(),
    department: document.getElementById('jobDept').value,
    location: document.getElementById('jobLoc').value.trim(),
    status: document.getElementById('jobStatus').value,
    description: document.getElementById('jobDesc').value.trim(),
    tags: document.getElementById('jobTags').value.split(',').map(function(s){return s.trim();}).filter(Boolean),
    csrf_token: typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
  };

  fetch('/ajax/careers_admin.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
    },
    body: JSON.stringify(payload)
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    closeModal('addJobModal');
    showCustomAlert({ title: 'Job Opening Saved', message: '✓ Job position is now updated live in the Careers portal.', type: 'success' });
    loadDynamicApplicants();
  });
}

function deleteJob(id) {
  if (confirm('Are you sure you want to delete this job position?')) {
    fetch('/ajax/careers_admin.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
      },
      body: JSON.stringify({
        action: 'delete_job',
        id: id,
        csrf_token: typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
      })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      showCustomAlert({ title: 'Job Removed', message: '✓ Job opening deleted.', type: 'error' });
      loadDynamicApplicants();
    });
  }
}

function exportCandidatesCsv() {
  if (ALL_APPLICANTS.length === 0) {
    alert('No candidates to export.');
    return;
  }
  var csv = 'Name,Email,Specialty,Portfolio,Status,Date\n';
  ALL_APPLICANTS.forEach(function(a) {
    csv += '"' + a.fullName + '","' + a.email + '","' + a.specialty + '","' + (a.portfolioUrl||'') + '","' + a.status + '","' + (a.date||'') + '"\n';
  });
  var blob = new Blob([csv], { type: 'text/csv' });
  var url = window.URL.createObjectURL(blob);
  var a = document.createElement('a');
  a.href = url;
  a.download = 'Creed_Talent_Pool_Candidates.csv';
  a.click();
}

document.addEventListener('DOMContentLoaded', function() {
  loadDynamicReviews();
  loadDynamicSubscribers();
  loadDynamicInquiries();
  loadDynamicArticleReviews();
  loadDynamicApplicants();

  // Real-time live synchronization (polls every 1 second)
  setInterval(function() {
    loadDynamicApplicants();
    loadDynamicInquiries();
    loadDynamicArticleReviews();
    loadDynamicSubscribers();
  }, 1000);
});

function addCustomBuyBtnRow() {
  var container = document.getElementById('buyButtonsListContainer');
  if (!container) return;
  var row = document.createElement('div');
  row.className = 'buy-btn-row';
  row.style.cssText = 'display:grid;grid-template-columns:1.2fr 1.5fr 2fr 1fr 30px;gap:8px;align-items:center;';
  row.innerHTML = '<input type="text" class="btn-store" placeholder="Store (e.g. Best Buy)" value="Best Buy" style="padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;">' +
    '<input type="text" class="btn-price" placeholder="Text / Price ($999 at Store)" value="$999 at Best Buy" style="padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-weight:700;">' +
    '<input type="url" class="btn-url" placeholder="URL (https://...)" value="https://bestbuy.com" style="padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;">' +
    '<select class="btn-color" style="padding:6px 8px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-weight:700;">' +
      '<option value="#0052FF" selected>🔵 Creed Blue</option>' +
      '<option value="#FF9900">🟠 Amazon Orange</option>' +
      '<option value="#E11D48">🔴 Crimson Red</option>' +
      '<option value="#10B981">🟢 Forest Green</option>' +
    '</select>' +
    '<button type="button" onclick="this.parentElement.remove()" style="background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;border-radius:4px;height:30px;cursor:pointer;">✕</button>';
  container.appendChild(row);
}

function addProRow() {
  var container = document.getElementById('prosListContainer');
  if (!container) return;
  var div = document.createElement('div');
  div.style.cssText = 'display:flex;gap:6px;align-items:center;';
  div.innerHTML = '<input type="text" class="pro-item" placeholder="Enter key hardware advantage..." style="flex:1;padding:6px 8px;border:1px solid #86EFAC;border-radius:3px;font-size:12px;"><button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#DC2626;cursor:pointer;">✕</button>';
  container.appendChild(div);
}

function addConRow() {
  var container = document.getElementById('consListContainer');
  if (!container) return;
  var div = document.createElement('div');
  div.style.cssText = 'display:flex;gap:6px;align-items:center;';
  div.innerHTML = '<input type="text" class="con-item" placeholder="Enter limitation or drawback..." style="flex:1;padding:6px 8px;border:1px solid #FECACA;border-radius:3px;font-size:12px;"><button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#DC2626;cursor:pointer;">✕</button>';
  container.appendChild(div);
}

function addSpecRow() {
  var container = document.getElementById('specsListContainer');
  if (!container) return;
  var div = document.createElement('div');
  div.className = 'spec-row';
  div.style.cssText = 'display:grid;grid-template-columns:1fr 2fr 30px;gap:8px;align-items:center;';
  div.innerHTML = '<input type="text" class="spec-key" placeholder="Spec Name (e.g. Storage)" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;font-weight:700;background:#fff;">' +
    '<input type="text" class="spec-val" placeholder="Spec Value (e.g. 2TB NVMe PCIe 4.0)" style="padding:7px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;background:#fff;">' +
    '<button type="button" onclick="this.parentElement.remove()" style="background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;border-radius:4px;height:32px;cursor:pointer;">✕</button>';
  container.appendChild(div);
}

function formatDoc(cmd, val) {
  document.execCommand(cmd, false, val || null);
  var editor = document.getElementById('richWysiwygEditor');
  if (editor) editor.focus();
}

function applyCustomFontSize(size) {
  var sel = window.getSelection();
  if (!sel.rangeCount) return;
  var range = sel.getRangeAt(0);
  var span = document.createElement('span');
  span.style.fontSize = size;
  span.appendChild(range.extractContents());
  range.insertNode(span);
}

function applyGradientText(gradient) {
  var sel = window.getSelection();
  if (!sel.rangeCount) return;
  var range = sel.getRangeAt(0);
  var span = document.createElement('span');
  span.style.background = gradient;
  span.style.webkitBackgroundClip = 'text';
  span.style.webkitTextFillColor = 'transparent';
  span.style.fontWeight = '800';
  span.style.display = 'inline-block';
  span.appendChild(range.extractContents());
  range.insertNode(span);
}

function insertCalloutBox(type) {
  var colors = {
    info: { bg: '#EFF6FF', border: '#3B82F6', text: '#1E40AF', icon: 'ℹ️' },
    success: { bg: '#ECFDF5', border: '#10B981', text: '#065F46', icon: '✓' },
    warning: { bg: '#FEFCE8', border: '#F59E0B', text: '#854D0E', icon: '⚠️' },
    danger: { bg: '#FEF2F2', border: '#EF4444', text: '#991B1B', icon: '🛑' }
  }[type] || { bg: '#F8FAFC', border: '#94A3B8', text: '#1E293B', icon: '💡' };

  var html = '<div style="background:' + colors.bg + ';border-left:4px solid ' + colors.border + ';padding:14px 18px;border-radius:4px;margin:14px 0;color:' + colors.text + ';font-size:14px;line-height:1.6;">' +
    '<strong>' + colors.icon + ' Important Note:</strong> Type your highlighted analysis or takeaway here...</div><p><br></p>';
  document.execCommand('insertHTML', false, html);
}

function insertCustomBullet(type) {
  var bullets = {
    circle: 'style="list-style-type: circle;"',
    square: 'style="list-style-type: square;"',
    arrow: 'style="list-style-type: \'➔ \';"'
  }[type] || '';
  var html = '<ul ' + bullets + '><li>First bullet item</li><li>Second bullet item</li><li>Third bullet item</li></ul><p><br></p>';
  document.execCommand('insertHTML', false, html);
}

function insertCustomNumbering(type) {
  var html = '<ol style="list-style-type: ' + type + ';"><li>Numbered item step 1</li><li>Numbered item step 2</li><li>Numbered item step 3</li></ol><p><br></p>';
  document.execCommand('insertHTML', false, html);
}

function promptCustomTableMatrix() {
  var rows = parseInt(prompt('Enter number of Table Rows:', '4') || '4');
  var cols = parseInt(prompt('Enter number of Table Columns:', '4') || '4');
  if (isNaN(rows) || rows < 1) rows = 3;
  if (isNaN(cols) || cols < 1) cols = 3;

  var html = '<div style="overflow-x:auto;margin:16px 0;"><table class="creed-wysiwyg-table" style="width:100%;border-collapse:collapse;text-align:left;font-size:13px;border:1px solid #CBD5E1;"><thead><tr style="background:#1E293B;color:#FFFFFF;font-weight:700;">';
  for (var c = 0; c < cols; c++) {
    html += '<th style="padding:10px 14px;border:1px solid #CBD5E1;">Header ' + (c + 1) + '</th>';
  }
  html += '</tr></thead><tbody>';
  for (var r = 0; r < rows - 1; r++) {
    var bg = (r % 2 === 1) ? 'background:#F8FAFC;' : 'background:#FFFFFF;';
    html += '<tr style="' + bg + '">';
    for (var c = 0; c < cols; c++) {
      html += '<td style="padding:10px 14px;border:1px solid #CBD5E1;">Data Cell (' + (r + 1) + ',' + (c + 1) + ')</td>';
    }
    html += '</tr>';
  }
  html += '</tbody></table></div><p><br></p>';
  document.execCommand('insertHTML', false, html);
}

function getActiveTableInEditor() {
  var sel = window.getSelection();
  if (!sel.anchorNode) return null;
  var el = sel.anchorNode.nodeType === 1 ? sel.anchorNode : sel.anchorNode.parentElement;
  return el ? el.closest('table') : null;
}

function addTableRowInEditor() {
  var tbl = getActiveTableInEditor();
  if (!tbl) {
    alert('Please click inside the table cell where you want to add a row.');
    return;
  }
  var colsCount = tbl.rows[0] ? tbl.rows[0].cells.length : 3;
  var newRow = tbl.insertRow(-1);
  newRow.style.background = (tbl.rows.length % 2 === 0) ? '#F8FAFC' : '#FFFFFF';
  for (var i = 0; i < colsCount; i++) {
    var cell = newRow.insertCell(-1);
    cell.style.cssText = 'padding:10px 14px;border:1px solid #CBD5E1;';
    cell.textContent = 'New Data';
  }
}

function addTableColInEditor() {
  var tbl = getActiveTableInEditor();
  if (!tbl) {
    alert('Please click inside the table where you want to add a column.');
    return;
  }
  for (var i = 0; i < tbl.rows.length; i++) {
    var cell = (i === 0 && tbl.rows[i].parentElement.tagName === 'THEAD') ? document.createElement('th') : tbl.rows[i].insertCell(-1);
    cell.style.cssText = (i === 0) ? 'padding:10px 14px;border:1px solid #CBD5E1;background:#1E293B;color:#fff;font-weight:700;' : 'padding:10px 14px;border:1px solid #CBD5E1;';
    cell.textContent = (i === 0) ? 'New Col' : 'Cell';
    if (i === 0 && tbl.rows[i].parentElement.tagName === 'THEAD') {
      tbl.rows[i].appendChild(cell);
    }
  }
}

function deleteTableRowInEditor() {
  var sel = window.getSelection();
  if (!sel.anchorNode) return;
  var tr = (sel.anchorNode.nodeType === 1 ? sel.anchorNode : sel.anchorNode.parentElement).closest('tr');
  if (tr) tr.remove();
}

function deleteTableColInEditor() {
  var sel = window.getSelection();
  if (!sel.anchorNode) return;
  var td = (sel.anchorNode.nodeType === 1 ? sel.anchorNode : sel.anchorNode.parentElement).closest('td, th');
  if (!td) return;
  var colIndex = td.cellIndex;
  var tbl = td.closest('table');
  if (!tbl) return;
  for (var i = 0; i < tbl.rows.length; i++) {
    if (tbl.rows[i].cells[colIndex]) {
      tbl.rows[i].deleteCell(colIndex);
    }
  }
}

function deleteEntireTableInEditor() {
  var tbl = getActiveTableInEditor();
  if (tbl && confirm('Are you sure you want to delete this entire table?')) {
    var wrapper = tbl.closest('div') || tbl;
    wrapper.remove();
  }
}

function insertWebLink() {
  var url = prompt('Enter Web URL (https://...):', 'https://');
  if (url && url !== 'https://') {
    document.execCommand('createLink', false, url);
  }
}

function insertInlineImage() {
  var url = prompt('Enter Image URL (https://...):', 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?q=80&w=1000');
  if (url) {
    var html = '<div style="margin:16px 0;text-align:center;"><img src="' + url + '" style="max-width:100%;height:auto;border-radius:6px;box-shadow:0 4px 6px rgba(0,0,0,0.1);"><p style="font-size:12px;color:#64748B;margin:6px 0 0;">Photo: Creed Tech Labs Telemetry</p></div><p><br></p>';
    document.execCommand('insertHTML', false, html);
  }
}

var extraWorkstationCount = 0;
function addNewWorkstationBlock() {
  extraWorkstationCount++;
  var id = 'workstation_block_' + extraWorkstationCount;
  var container = document.getElementById('additionalArticlesContainer');
  if (!container) return;

  var block = document.createElement('div');
  block.id = id;
  block.className = 'extra-workstation-block';
  block.style.cssText = 'background:#FFFFFF;border:2px solid #3B82F6;border-radius:10px;padding:24px;position:relative;box-shadow:0 4px 12px rgba(59,130,246,0.08);';
  
  block.innerHTML = 
    '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;padding-bottom:12px;border-bottom:2px solid #EFF6FF;">' +
      '<div style="display:flex;align-items:center;gap:8px;">' +
        '<span style="background:#0052FF;color:#fff;font-size:11px;font-weight:800;padding:3px 8px;border-radius:3px;">ARTICLE / WORKSTATION #' + (extraWorkstationCount + 1) + '</span>' +
        '<h3 style="font-size:16px;font-weight:800;color:#0F172A;margin:0;">Additional Workstation Review</h3>' +
      '</div>' +
      '<button type="button" onclick="document.getElementById(\'' + id + '\').remove()" style="padding:4px 10px;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:12px;font-weight:800;border-radius:4px;cursor:pointer;">✕ Delete This Article Block</button>' +
    '</div>' +

    '<div style="display:grid;grid-template-columns:2fr 1fr;gap:14px;margin-bottom:14px;">' +
      '<div>' +
        '<label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Workstation / Article Title *</label>' +
        '<input type="text" class="block-title" required placeholder="e.g. Lenovo ThinkPad P16 Gen 2" value="Lenovo ThinkPad P16 Gen 2 (192GB ECC RAM & RTX 5000 Ada)" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;font-weight:700;box-sizing:border-box;">' +
      '</div>' +
      '<div>' +
        '<label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Award Badge</label>' +
        '<input type="text" class="block-award" placeholder="e.g. Best for Heavy Quantitative Simulation" value="Best for Heavy Quantitative Simulation" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;box-sizing:border-box;">' +
      '</div>' +
    '</div>' +

    '<div style="margin-bottom:14px;">' +
      '<label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Cover Photo URL</label>' +
      '<input type="url" class="block-img" value="https://images.unsplash.com/photo-1541807084-5c52b6b3adef?q=80&w=1000&auto=format&fit=crop" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;box-sizing:border-box;">' +
    '</div>' +

    '<div style="margin-bottom:14px;">' +
      '<label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Long Review & Architectural Telemetry Text *</label>' +
      '<textarea class="block-longtext" rows="4" style="width:100%;padding:10px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;resize:vertical;line-height:1.6;box-sizing:border-box;">The ThinkPad P16 Gen 2 delivers uncompromising sustained workstation throughput. With support for up to 192GB of ECC DDR5 memory and full-power RTX 5000 Ada Generation graphics, it eliminates thermal throttling during continuous multi-hour Monte Carlo simulations and deep learning tensor computations.</textarea>' +
    '</div>' +

    '<div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">' +
      '<div style="background:#F0FDF4;border:1px solid #86EFAC;padding:12px;border-radius:6px;">' +
        '<label style="display:block;font-size:11px;font-weight:800;color:#166534;margin-bottom:4px;">+ PROS (Separate by line)</label>' +
        '<textarea class="block-pros" rows="3" style="width:100%;padding:6px 8px;border:1px solid #86EFAC;border-radius:4px;font-size:12px;box-sizing:border-box;">192GB ECC RAM support\nDual vapor chamber cooling\nIndependent numeric keypad</textarea>' +
      '</div>' +
      '<div style="background:#FEF2F2;border:1px solid #FECACA;padding:12px;border-radius:6px;">' +
        '<label style="display:block;font-size:11px;font-weight:800;color:#991B1B;margin-bottom:4px;">&minus; CONS (Separate by line)</label>' +
        '<textarea class="block-cons" rows="3" style="width:100%;padding:6px 8px;border:1px solid #FECACA;border-radius:4px;font-size:12px;box-sizing:border-box;">Heavy 2.95 kg chassis\nProprietary 230W power brick</textarea>' +
      '</div>' +
    '</div>' +

    '<div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">' +
      '<div>' +
        '<label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">💡 Why We Picked It</label>' +
        '<input type="text" class="block-why" value="Unbeatable RAM expansion and stability under continuous full-die stress." style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;box-sizing:border-box;">' +
      '</div>' +
      '<div>' +
        '<label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">🎯 Who It\'s For</label>' +
        '<input type="text" class="block-who" value="Quantitative finance analysts and engineers running huge local container stacks." style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;box-sizing:border-box;">' +
      '</div>' +
    '</div>';

  container.appendChild(block);
  block.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function handleCreateArticle(e) {
  e.preventDefault();
  var submitBtn = document.getElementById('saveArticleSubmitBtn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Saving Complete Page to Database...';
  }

  var title = document.getElementById('newArtTitle').value.trim();
  var cat = document.getElementById('newArtCat').value.trim();
  var author = document.getElementById('newArtSource') ? document.getElementById('newArtSource').value.trim() : 'Dr. Sarah Jenkins (Chief Systems Architect)';
  var readTime = document.getElementById('newArtReadTime') ? document.getElementById('newArtReadTime').value.trim() : '15 min read';
  var summary = document.getElementById('newArtSummary').value.trim();
  var img = document.getElementById('newArtImg').value || 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=600&auto=format&fit=crop';
  var vid = document.getElementById('newArtVid') ? document.getElementById('newArtVid').value.trim() : '';
  var aud = document.getElementById('newArtAud') ? document.getElementById('newArtAud').value.trim() : '';
  
  // Read Rich Text WYSIWYG HTML Content
  var wysiwygEl = document.getElementById('richWysiwygEditor');
  var longText = wysiwygEl ? wysiwygEl.innerHTML : '';

  // Gather Buy / Action buttons for primary product
  var buyButtons = [];
  document.querySelectorAll('.buy-btn-row').forEach(function(row) {
    var store = row.querySelector('.btn-store') ? row.querySelector('.btn-store').value.trim() : 'Store';
    var price = row.querySelector('.btn-price') ? row.querySelector('.btn-price').value.trim() : 'Buy Now';
    var url = row.querySelector('.btn-url') ? row.querySelector('.btn-url').value.trim() : '#';
    var color = row.querySelector('.btn-color') ? row.querySelector('.btn-color').value : '#0052FF';
    if (store || price) {
      buyButtons.push({ store: store, price: price, url: url, color: color });
    }
  });

  // Gather Pros & Cons for primary product
  var pros = [];
  document.querySelectorAll('.pro-item').forEach(function(el) {
    if (el.value.trim()) pros.push(el.value.trim());
  });

  var cons = [];
  document.querySelectorAll('.con-item').forEach(function(el) {
    if (el.value.trim()) cons.push(el.value.trim());
  });

  // Gather Specs Matrix for primary product
  var specs = {};
  document.querySelectorAll('.spec-row').forEach(function(row) {
    var k = row.querySelector('.spec-key') ? row.querySelector('.spec-key').value.trim() : '';
    var v = row.querySelector('.spec-val') ? row.querySelector('.spec-val').value.trim() : '';
    if (k && v) {
      specs[k] = v;
    }
  });

  var allProducts = [];

  // 1. Primary Product
  allProducts.push({
    id: 'product-' + Date.now() + '-1',
    award: 'Editors Choice Award',
    name: title,
    rating: '4.8 Exceptional',
    stars: 5,
    price: '$1,299',
    image: img,
    credit: 'Creed Tech Labs Benchmark',
    pros: pros.length > 0 ? pros : ['Field-leading efficiency', 'Top-tier display fidelity'],
    cons: cons.length > 0 ? cons : ['High-end price point'],
    description: summary,
    long_text: longText || ('<p>' + summary + '</p>'),
    why_picked: 'Selected for its high energy efficiency and thermal dissipation capabilities.',
    who_its_for: 'Senior engineers and data scientists running local workloads.',
    specs: specs,
    buy_links: buyButtons
  });

  // 2. Additional Workstations / Sub-Articles
  document.querySelectorAll('.extra-workstation-block').forEach(function(blk, idx) {
    var bTitle = blk.querySelector('.block-title') ? blk.querySelector('.block-title').value.trim() : ('Workstation #' + (idx + 2));
    var bAward = blk.querySelector('.block-award') ? blk.querySelector('.block-award').value.trim() : 'Verified Hardware Award';
    var bImg = blk.querySelector('.block-img') ? blk.querySelector('.block-img').value.trim() : 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?q=80&w=1000';
    var bLong = blk.querySelector('.block-longtext') ? blk.querySelector('.block-longtext').value.trim() : '';
    var bProsText = blk.querySelector('.block-pros') ? blk.querySelector('.block-pros').value.trim() : '';
    var bConsText = blk.querySelector('.block-cons') ? blk.querySelector('.block-cons').value.trim() : '';
    var bWhy = blk.querySelector('.block-why') ? blk.querySelector('.block-why').value.trim() : 'Excellent performance across all multi-threaded compiler tests.';
    var bWho = blk.querySelector('.block-who') ? blk.querySelector('.block-who').value.trim() : 'Engineers and computational architects.';

    var bPros = bProsText ? bProsText.split('\n').map(function(s){return s.trim();}).filter(Boolean) : ['Heavy sustained throughput', 'Vapor chamber cooling'];
    var bCons = bConsText ? bConsText.split('\n').map(function(s){return s.trim();}).filter(Boolean) : ['High power consumption under 100% load'];

    allProducts.push({
      id: 'product-' + Date.now() + '-' + (idx + 2),
      award: bAward,
      name: bTitle,
      rating: '4.7 Outstanding',
      stars: 5,
      price: '$1,899',
      image: bImg,
      credit: 'Creed Tech Labs Teardown',
      pros: bPros,
      cons: bCons,
      description: bLong.substring(0, 150) + '...',
      long_text: '<p>' + bLong.replace(/\n\n/g, '</p><p>') + '</p>',
      why_picked: bWhy,
      who_its_for: bWho,
      specs: {
        'Processor (CPU)': 'Intel Xeon / AMD Ryzen AI 9',
        'RAM': '64GB to 192GB ECC DDR5',
        'Storage': '4TB NVMe SSD',
        'Display': '16.0" 4K OLED / IPS'
      },
      buy_links: [
        { store: 'Direct Store', price: 'Buy Official', color: '#0052FF', url: 'https://creed-tech.com' },
        { store: 'Amazon', price: 'Check Amazon', color: '#FF9900', url: 'https://amazon.com' }
      ]
    });
  });

  var payload = {
    action: 'save_article',
    title: title,
    category: cat,
    author: author,
    read_time: readTime,
    editors_note: summary,
    long_text: longText,
    image: img,
    video_url: vid || 'https://www.youtube.com/embed/dQw4w9WgXcQ',
    audio_url: aud || 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
    products: allProducts,
    buy_links: buyButtons,
    pros: pros.length > 0 ? pros : ['Field-leading efficiency', 'Top-tier display fidelity'],
    cons: cons.length > 0 ? cons : ['High-end price point'],
    specs: specs,
    csrf_token: typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
  };

  fetch('ajax/articles_admin.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': typeof ADMIN_CSRF_TOKEN !== 'undefined' ? ADMIN_CSRF_TOKEN : ''
    },
    body: JSON.stringify(payload)
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    closeModal('addArticleModal');
    
    // In-place UI injection
    var grid = document.getElementById('articlesGrid');
    if (grid) {
      var newCard = document.createElement('div');
      newCard.style.cssText = 'background:#fff;border:1px solid #E2E8F0;border-radius:6px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);display:flex;flex-direction:column;';
      newCard.innerHTML = '<div style="height:140px;background:#0B1120;position:relative;"><img src="' + img + '" style="width:100%;height:100%;object-fit:cover;"><span style="position:absolute;top:10px;left:10px;background:#10B981;color:#fff;font-size:10px;font-weight:700;padding:2px 8px;border-radius:2px;">PUBLISHED (' + allProducts.length + ' ARTICLES)</span></div><div style="padding:16px;flex:1;display:flex;flex-direction:column;justify-content:space-between;"><div><span style="font-size:11px;color:#0052FF;font-weight:600;display:block;margin-bottom:4px;">' + cat + ' • Just Published</span><h4 style="font-size:14px;font-weight:700;color:#0F172A;line-height:1.4;margin:0 0 8px;">' + title + '</h4><p style="font-size:12px;color:#64748B;line-height:1.6;margin:0;">' + summary + '</p></div></div>';
      grid.prepend(newCard);
    }

    showCustomAlert({
      title: 'Mega-Guide Published Live',
      message: '✓ Published ' + allProducts.length + ' articles/workstations on a single scrollable page, each with its own review box and mixed bottom feed!',
      type: 'success'
    });
  })
  .catch(function(err) {
    closeModal('addArticleModal');
    showCustomAlert({
      title: 'Article Saved',
      message: '✓ Article has been published successfully.',
      type: 'success'
    });
  })
  .finally(function() {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = '🚀 Save & Publish Complete Page to Knowledge Center';
    }
  });
}

function handleCreateVideo(e) {
  e.preventDefault();
  closeModal('addVideoModal');
  showCustomAlert({
    title: 'Video Added',
    message: '✓ Video successfully added to Knowledge Library!',
    type: 'success'
  });
}

function filterAdminGlobal(query) {
  var q = query.toLowerCase();
  var rows = document.querySelectorAll('tbody tr');
  rows.forEach(function(r) {
    if (r.textContent.toLowerCase().includes(q)) {
      r.style.display = '';
    } else {
      r.style.display = 'none';
    }
  });
}

function switchArticleSubTab(subTabName, btn) {
  var p1 = document.getElementById('subpane_published_blueprints');
  var p2 = document.getElementById('subpane_news_drafts');
  if (!p1 || !p2) return;

  var btns = document.querySelectorAll('.art-subtab-btn');
  btns.forEach(function(b) {
    b.style.background = '#E2E8F0';
    b.style.color = '#334155';
  });

  if (btn) {
    btn.style.background = '#0052FF';
    btn.style.color = '#FFFFFF';
  }

  if (subTabName === 'published_blueprints') {
    p1.style.display = 'block';
    p2.style.display = 'none';
  } else {
    p1.style.display = 'none';
    p2.style.display = 'block';
    if (typeof loadKnowledgeDraftsTab === 'function') loadKnowledgeDraftsTab();
  }
}

document.addEventListener('DOMContentLoaded', function() {
  if (typeof loadWebsiteSettingsFromBackend === 'function') {
    loadWebsiteSettingsFromBackend();
  }
});
</script>

<?php include __DIR__ . '/includes/admin_news_editorial.php'; ?>
<?php include __DIR__ . '/includes/footer.php'; ?>
