<!-- WIDGET 1: TOP STORIES -->
<div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
    <h4 style="font-size:0.875rem;font-weight:800;color:#030712;text-transform:uppercase;margin:0;">Top Stories</h4>
    <div style="display:flex;align-items:center;gap:6px;">
      <button style="width:1.5rem;height:1.5rem;background:#F3F4F6;border:1px solid #E5E7EB;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:12px;">‹</button>
      <button style="width:1.5rem;height:1.5rem;background:#F3F4F6;border:1px solid #E5E7EB;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:12px;">›</button>
    </div>
  </div>

  <div style="display:flex;flex-direction:column;gap:1rem;">
    
    <a href="javascript:void(0)" onclick="openDynamicArticle(1, event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;">
      <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#1E293B;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
        💻
      </div>
      <div>
        <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">The 7 Best Enterprise AI &amp; Cloud Laptops in 2026</h5>
        <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">15-Aug-2026</span>
      </div>
    </a>

    <a href="javascript:void(0)" onclick="openDynamicArticle(2, event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;padding-top:0.5rem;border-top:1px solid #F9FAFB;">
      <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
        🤖
      </div>
      <div>
        <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Autonomous Neural Security Clusters</h5>
        <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">20-May-2024</span>
      </div>
    </a>

    <a href="javascript:void(0)" onclick="openDynamicArticle(3, event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;padding-top:0.5rem;border-top:1px solid #F9FAFB;">
      <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#1E293B;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
        📈
      </div>
      <div>
        <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">International Growth &amp; Cloud Scaling</h5>
        <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">25-Apr-2024</span>
      </div>
    </a>

  </div>
</div>

<!-- WIDGET 2: SPECIAL FEATURE (WATCH NOW VIDEO MODAL) -->
<div style="background:#0B1120;color:#fff;border-radius:1rem;padding:1.5rem;position:relative;overflow:hidden;border:1px solid #1F2937;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
  <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(to right,#4ADE80,#22D3EE,#3B82F6);"></div>
  <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">Special Feature</span>
  <p style="font-size:12.5px;color:#D1D5DB;line-height:1.6;margin:0 0 1.25rem;">Watch our exclusive video briefings &amp; live architecture teardowns.</p>
  <button onclick="openVideoModal()" style="padding:8px 20px;background:#E53935;color:#fff;font-weight:700;font-size:12px;border:none;cursor:pointer;border-radius:2px;box-shadow:0 4px 6px -1px rgba(229,57,53,0.4);transition:background 0.2s;" onmouseover="this.style.background='#C62828'" onmouseout="this.style.background='#E53935'">Watch Now</button>
</div>

<!-- WIDGET 3: NEWEST VIDEOS -->
<div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
    <h4 style="font-size:0.875rem;font-weight:800;color:#030712;text-transform:uppercase;margin:0;">Newest Videos</h4>
    <div style="display:flex;align-items:center;gap:6px;">
      <button style="width:1.5rem;height:1.5rem;background:#F3F4F6;border:1px solid #E5E7EB;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:12px;">‹</button>
      <button style="width:1.5rem;height:1.5rem;background:#F3F4F6;border:1px solid #E5E7EB;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:12px;">›</button>
    </div>
  </div>

  <div style="display:flex;flex-direction:column;gap:1rem;">
    
    <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
      <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
        ▶
      </div>
      <div>
        <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">WHAT ARE SOCIAL ADVERTISING?</h5>
        <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">25-Apr-2024</span>
      </div>
    </div>

    <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
      <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
        ▶
      </div>
      <div>
        <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">ENTERPRISE AI ARCHITECTURE</h5>
        <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">18-Apr-2024</span>
      </div>
    </div>

    <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
      <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
        ▶
      </div>
      <div>
        <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">HYBRID CLOUD DEVOPS TEARDOWN</h5>
        <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">12-May-2024</span>
      </div>
    </div>

  </div>
</div>

<!-- WIDGET 4: SPECIAL FEATURE 2 -->
<div style="background:#0B1120;color:#fff;border-radius:1rem;padding:1.5rem;position:relative;overflow:hidden;border:1px solid #1F2937;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
  <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(to right,#FB923C,#EF4444,#EC4899);"></div>
  <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">Special Feature</span>
  <p style="font-size:12.5px;color:#D1D5DB;line-height:1.6;margin:0 0 1.25rem;">Explore our high-throughput AI infrastructure benchmarks.</p>
  <button onclick="openVideoModal()" style="padding:8px 20px;background:#E53935;color:#fff;font-weight:700;font-size:12px;border:none;cursor:pointer;border-radius:2px;box-shadow:0 4px 6px -1px rgba(229,57,53,0.4);transition:background 0.2s;" onmouseover="this.style.background='#C62828'" onmouseout="this.style.background='#E53935'">Watch Now</button>
</div>

<!-- WIDGET 5: UPCOMING EVENTS -->
<div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
    <h4 style="font-size:0.875rem;font-weight:800;color:#030712;text-transform:uppercase;margin:0;">Upcoming Events</h4>
    <div style="display:flex;align-items:center;gap:6px;">
      <button style="width:1.5rem;height:1.5rem;background:#F3F4F6;border:1px solid #E5E7EB;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:12px;">‹</button>
      <button style="width:1.5rem;height:1.5rem;background:#F3F4F6;border:1px solid #E5E7EB;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:12px;">›</button>
    </div>
  </div>

  <div style="display:flex;flex-direction:column;gap:1rem;">
    
    <div onclick="openEventModal('International Conference on World Cloud Architecture')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
      <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
        <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">13</span>
        <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">APR</span>
      </div>
      <div>
        <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">International Conference on World Cloud Architecture</h5>
        <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">25-Apr-2026</span>
      </div>
    </div>

    <div onclick="openEventModal('Global AI & Autonomous Agents Summit 2026')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
      <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
        <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">28</span>
        <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">MAY</span>
      </div>
      <div>
        <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Global AI &amp; Autonomous Agents Summit 2026</h5>
        <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">28-May-2026</span>
      </div>
    </div>

    <div onclick="openEventModal('Enterprise Cybersecurity & Threat Modeling Workshop')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
      <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
        <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">15</span>
        <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">JUN</span>
      </div>
      <div>
        <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Enterprise Cybersecurity &amp; Threat Modeling Workshop</h5>
        <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">15-Jun-2026</span>
      </div>
    </div>

  </div>
</div>
