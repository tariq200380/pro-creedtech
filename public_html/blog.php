<?php
/**
 * Canonical Route: Knowledge Center is the unified authoritative intelligence & news hub
 */
if (php_sapi_name() !== 'cli' && !headers_sent()) {
    header("Location: /knowledge-center", true, 301);
}
require __DIR__ . '/knowledge-center.php';
exit;
?>

<div style="width:100%;background:#FAFAFC;color:#111827;font-family:sans-serif;text-align:left;">
  
  <!-- 1. HERO SECTION: LIVE TELEMETRY & BREAKING TECH HEADLINES -->
  <section style="width:100%;background:#070D1E;color:#fff;padding:6rem 0 3.5rem;position:relative;overflow:hidden;border-bottom:1px solid #1F2937;">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 20% 40%, rgba(0, 102, 255, 0.22) 0%, transparent 60%), radial-gradient(circle at 80% 60%, rgba(255, 107, 0, 0.12) 0%, transparent 55%);"></div>
    <div style="position:absolute;inset:0;opacity:0.15;pointer-events:none;background-image:linear-gradient(to right, rgba(0, 150, 255, 0.2) 1px, transparent 1px), linear-gradient(to bottom, rgba(0, 150, 255, 0.2) 1px, transparent 1px);background-size:40px 40px;"></div>

    <div style="max-width:80rem;margin:0 auto;padding:0 3rem;position:relative;z-index:10;">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:3.5rem;align-items:center;">
        
        <!-- Left Telemetry Visuals -->
        <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:1rem;padding:2rem;backdrop-filter:blur(12px);box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);">
          
          <div style="margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid rgba(255,255,255,0.1);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
              <span style="font-size:0.75rem;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;">Visitors</span>
              <div style="display:flex;align-items:center;gap:12px;font-size:0.75rem;color:#22D3EE;font-family:monospace;">
                <span>48 hours</span>
                <span style="color:#6B7280;">|</span>
                <span>48 hrs</span>
                <span style="color:#fff;font-weight:700;font-size:0.875rem;background:rgba(37,99,235,0.3);padding:2px 8px;border-radius:2px;">78 M</span>
              </div>
            </div>

            <!-- SVG Waveform Graph -->
            <div style="width:100%;height:5rem;position:relative;">
              <svg style="width:100%;height:100%;" viewBox="0 0 400 80" fill="none">
                <path d="M0 40 Q50 10 100 40 T200 40 T300 40 T400 30" stroke="#00A3FF" stroke-width="3" stroke-linecap="round" />
                <path d="M0 50 Q60 25 120 50 T240 50 T360 45 T400 40" stroke="#0066FF" stroke-width="2" stroke-opacity="0.5" />
                <circle cx="100" cy="40" r="6" fill="#00A3FF" opacity="0.6">
                  <animate attributeName="r" values="4;8;4" dur="2s" repeatCount="indefinite"/>
                  <animate attributeName="opacity" values="0.8;0.2;0.8" dur="2s" repeatCount="indefinite"/>
                </circle>
                <circle cx="100" cy="40" r="4" fill="#FFFFFF" />
                <circle cx="300" cy="40" r="4" fill="#00A3FF" />
              </svg>
            </div>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;align-items:center;padding-top:0.25rem;">
            <div>
              <span style="font-size:11px;color:#9CA3AF;font-weight:600;display:block;margin-bottom:4px;">/Icce Visitors</span>
              <span style="font-size:2.25rem;font-weight:600;color:#fff;letter-spacing:-0.03em;display:block;line-height:1;">142</span>
              <span style="font-size:0.75rem;color:#9CA3AF;font-weight:500;margin-top:4px;display:block;">Top Articles</span>
            </div>

            <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;">
              <div style="text-align:right;">
                <span style="font-size:0.75rem;color:#9CA3AF;display:block;font-weight:600;">Top Articles</span>
                <span style="font-size:1.75rem;font-weight:600;color:#22D3EE;line-height:1.2;">73%</span>
              </div>
              <div style="width:3rem;height:3rem;border-radius:0;border:4px solid rgba(34,211,238,0.2);border-top-color:#22D3EE;border-right-color:#22D3EE;display:flex;align-items:center;justify-content:center;">
                <div style="width:8px;height:8px;background:#22D3EE;"></div>
              </div>
            </div>
          </div>

        </div>

        <!-- Right Editorial Headlines -->
        <div style="text-align:left;display:flex;flex-direction:column;gap:1.5rem;">
          <div style="display:flex;flex-direction:column;gap:1rem;">
            <a href="blog" style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:600;color:#fff;letter-spacing:-0.02em;line-height:1.3;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#22D3EE'" onmouseout="this.style.color='#fff'">
              The 7 Best Enterprise AI &amp; Cloud Laptops for Senior Engineers &amp; Architects
            </a>

            <a href="blog" style="font-size:clamp(1.25rem,2.2vw,1.75rem);font-weight:700;color:#D1D5DB;letter-spacing:-0.02em;line-height:1.3;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#22D3EE'" onmouseout="this.style.color='#D1D5DB'">
              Tech Company Announces Major AI Breakthrough
            </a>
          </div>

          <div style="padding-top:0.5rem;">
            <span style="font-size:1.5rem;font-weight:600;letter-spacing:0.15em;color:#22D3EE;text-transform:uppercase;text-shadow:0 0 12px rgba(0,163,255,0.4);">
              AI WRITING ASSISTANT
            </span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- 2. LATEST IT & BUSINESS NEWS SECTION (Interactive 3-Story Showcase) -->
  <section style="width:100%;padding:4rem 0;background:#F8FAFC;border-bottom:1px solid #E2E8F0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 3rem;">
      
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;padding-bottom:1rem;border-bottom:2px solid #E2E8F0;">
        <div style="display:flex;align-items:center;gap:12px;">
          <span style="background:#EF4444;color:#fff;font-size:10px;font-weight:800;padding:4px 8px;border-radius:2px;letter-spacing:0.08em;text-transform:uppercase;">LIVE BREAKING NEWS</span>
          <h2 style="font-size:1.5rem;font-weight:700;color:#0F172A;margin:0;letter-spacing:-0.02em;">Latest IT &amp; Business Intelligence</h2>
        </div>
        <span style="font-size:12px;color:#64748B;font-family:monospace;font-weight:600;">⚡ REAL-TIME ENTERPRISE RSS SYNC</span>
      </div>

      <div style="display:grid;grid-template-columns:7fr 5fr;gap:2rem;align-items:start;">
        
        <!-- Left: Active Lead Story Big Card -->
        <div id="itLeadCard" style="background:#fff;border:1px solid #CBD5E1;border-radius:1rem;overflow:hidden;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);transition:all 0.3s;">
          <div style="width:100%;height:18rem;position:relative;background:#0F172A;overflow:hidden;">
            <img id="itLeadImg" src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?w=1200&auto=format&fit=crop&q=80" alt="News Image" style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <span id="itLeadCat" style="position:absolute;top:1rem;left:1rem;background:#2563EB;color:#fff;font-size:10px;font-weight:700;padding:4px 10px;border-radius:2px;letter-spacing:0.05em;text-transform:uppercase;">TECHCRUNCH ENTERPRISE</span>
          </div>
          <div style="padding:1.75rem;">
            <div style="display:flex;align-items:center;gap:10px;font-size:12px;color:#64748B;margin-bottom:8px;font-weight:500;">
              <span id="itLeadSource">🌐 TechCrunch</span>
              <span>•</span>
              <span id="itLeadDate">Aug 15, 2026</span>
              <span>•</span>
              <span id="itLeadTime">4 min read</span>
            </div>
            <h3 id="itLeadTitle" style="font-size:1.375rem;font-weight:700;color:#0F172A;line-height:1.35;margin:0 0 12px;">Talks to sell PayPal to Stripe and Advent are heating up</h3>
            <p id="itLeadSummary" style="font-size:0.875rem;color:#475569;line-height:1.7;margin:0 0 16px;">PayPal is reportedly negotiating a potential sale to Stripe and private equity firm Advent, as the fintech firm's new CEO attempts to accelerate enterprise payment rails.</p>
            <ul id="itLeadBullets" style="list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;">
              <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#0052FF;font-weight:700;">✓</span> Multi-billion dollar transactional rails consolidation</li>
              <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#0052FF;font-weight:700;">✓</span> High-throughput global API gateway synergies</li>
              <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#0052FF;font-weight:700;">✓</span> Accelerating cross-border enterprise settlement speed</li>
            </ul>
            <a id="itLeadBtn" href="https://techcrunch.com/category/enterprise/" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:6px;padding:10px 20px;background:#0052FF;color:#fff;font-size:12px;font-weight:700;text-decoration:none;border-radius:2px;transition:background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">Read Full Article &rarr;</a>
          </div>
        </div>

        <!-- Right: 3 Selectable Story Cards -->
        <div style="display:flex;flex-direction:column;gap:1rem;">
          
          <!-- Story 0 -->
          <div onclick="selectITStory(0)" id="itStoryCard-0" style="background:#fff;border:2px solid #0052FF;border-radius:12px;padding:1.25rem;cursor:pointer;transition:all 0.2s;box-shadow:0 4px 6px -1px rgba(0,82,255,0.1);">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
              <span style="font-size:10px;font-weight:700;color:#0052FF;text-transform:uppercase;background:#EFF6FF;padding:2px 6px;border-radius:2px;">TECHCRUNCH</span>
              <span style="font-size:11px;color:#94A3B8;">Aug 15, 2026</span>
            </div>
            <h4 style="font-size:0.9375rem;font-weight:700;color:#0F172A;line-height:1.4;margin:0 0 6px;">Talks to sell PayPal to Stripe and Advent are heating up</h4>
            <p style="font-size:12px;color:#64748B;line-height:1.5;margin:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">PayPal is reportedly negotiating a potential sale to Stripe and private equity firm Advent...</p>
          </div>

          <!-- Story 1 -->
          <div onclick="selectITStory(1)" id="itStoryCard-1" style="background:#fff;border:1px solid #E2E8F0;border-radius:12px;padding:1.25rem;cursor:pointer;transition:all 0.2s;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
              <span style="font-size:10px;font-weight:700;color:#EA580C;text-transform:uppercase;background:#FFF7ED;padding:2px 6px;border-radius:2px;">CREED TECH PRESS</span>
              <span style="font-size:11px;color:#94A3B8;">Aug 15, 2026</span>
            </div>
            <h4 style="font-size:0.9375rem;font-weight:700;color:#0F172A;line-height:1.4;margin:0 0 6px;">Creed Tech Launches Autonomous Multi-Agent Cloud Infrastructure</h4>
            <p style="font-size:12px;color:#64748B;line-height:1.5;margin:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">Our engineering squad deploys sovereign air-gapped neural agent clusters that automate Kubernetes...</p>
          </div>

          <!-- Story 2 -->
          <div onclick="selectITStory(2)" id="itStoryCard-2" style="background:#fff;border:1px solid #E2E8F0;border-radius:12px;padding:1.25rem;cursor:pointer;transition:all 0.2s;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
              <span style="font-size:10px;font-weight:700;color:#059669;text-transform:uppercase;background:#ECFDF5;padding:2px 6px;border-radius:2px;">QUANTUM CRYPTO</span>
              <span style="font-size:11px;color:#94A3B8;">Aug 14, 2026</span>
            </div>
            <h4 style="font-size:0.9375rem;font-weight:700;color:#0F172A;line-height:1.4;margin:0 0 6px;">Post-Quantum Lattice Encryption Standardized for Banking</h4>
            <p style="font-size:12px;color:#64748B;line-height:1.5;margin:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">International central banks and payment institutions mandate post-quantum lattice cryptography...</p>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- 3. BIG TECH NEWS WIRE SECTION (Google, OpenAI, Microsoft, NVIDIA, Apple) -->
  <section style="width:100%;padding:4rem 0;background:#fff;border-bottom:1px solid #E2E8F0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 3rem;">
      
      <div style="text-align:center;max-width:48rem;margin:0 auto 2.5rem;">
        <span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.1em;display:block;margin-bottom:6px;">FRONTIER SILICON &amp; FOUNDATION MODELS</span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#0F172A;letter-spacing:-0.02em;">Big Tech Enterprise Wire</h2>
      </div>

      <!-- 5 Brand Tabs -->
      <div style="display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:8px;margin-bottom:2.5rem;">
        <button onclick="selectWireBrand('google')" id="wireBtn-google" style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:4px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#0052FF;color:#fff;box-shadow:0 4px 6px -1px rgba(0,82,255,0.3);">
          <span>🌐</span> Google
        </button>
        <button onclick="selectWireBrand('openai')" id="wireBtn-openai" style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:4px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>🤖</span> OpenAI
        </button>
        <button onclick="selectWireBrand('microsoft')" id="wireBtn-microsoft" style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:4px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>💻</span> Microsoft
        </button>
        <button onclick="selectWireBrand('nvidia')" id="wireBtn-nvidia" style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:4px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>⚡</span> NVIDIA
        </button>
        <button onclick="selectWireBrand('apple')" id="wireBtn-apple" style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:4px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>🍎</span> Apple
        </button>
      </div>

      <!-- Selected Brand Story Showcase Card -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:1rem;padding:2.5rem;display:grid;grid-template-columns:1fr 1fr;gap:2.5rem;align-items:center;">
        <div style="height:18rem;border-radius:12px;overflow:hidden;background:#0B1120;">
          <img id="wireImg" src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=1000&auto=format&fit=crop&q=80" alt="Wire Image" style="width:100%;height:100%;object-fit:cover;">
        </div>
        <div>
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;">
            <span id="wireCat" style="background:#DBEAFE;color:#1E40AF;font-size:10px;font-weight:700;padding:4px 8px;border-radius:2px;text-transform:uppercase;">GOOGLE QUANTUM &amp; AI</span>
            <span id="wireDate" style="font-size:12px;color:#64748B;">Aug 15, 2026 • 3 min read</span>
          </div>
          <h3 id="wireTitle" style="font-size:1.375rem;font-weight:700;color:#0F172A;line-height:1.35;margin:0 0 12px;">Google Quantum AI Achieves Major Error Reduction Milestone on Willow Processor</h3>
          <p id="wireSummary" style="font-size:0.875rem;color:#475569;line-height:1.7;margin:0 0 16px;">Google researchers demonstrate scalable fault-tolerant quantum operations, reducing logical error rates exponentially with increased physical qubit count.</p>
          <ul id="wireBullets" style="list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;">
            <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#0052FF;font-weight:700;">✓</span> Sub-threshold quantum error correction verified</li>
            <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#0052FF;font-weight:700;">✓</span> Willow chip architecture delivers 105 physical qubits</li>
            <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#0052FF;font-weight:700;">✓</span> Direct integration with Google Cloud TPU clusters</li>
          </ul>
          <a id="wireSourceBtn" href="https://blog.google/technology/ai/" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:#0052FF;text-decoration:none;">Read Original on <span id="wireSourceName">Google The Keyword</span> &rarr;</a>
        </div>
      </div>

    </div>
  </section>

  <!-- 4. PAKISTAN & REGIONAL TECH ECOSYSTEM WIRE SECTION -->
  <section style="width:100%;padding:4rem 0;background:#F8FAFC;border-bottom:1px solid #E2E8F0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 3rem;">
      
      <div style="text-align:center;max-width:48rem;margin:0 auto 2.5rem;">
        <span style="font-size:11px;font-weight:700;color:#059669;text-transform:uppercase;letter-spacing:0.1em;display:block;margin-bottom:6px;">NATIONAL TELECOM &amp; FIBER INFRASTRUCTURE</span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#0F172A;letter-spacing:-0.02em;">Pakistan &amp; Regional Tech Ecosystem</h2>
      </div>

      <!-- 4 Regional Tabs -->
      <div style="display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:8px;margin-bottom:2.5rem;">
        <button onclick="selectRegionalTab('pta')" id="regBtn-pta" style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:4px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#059669;color:#fff;box-shadow:0 4px 6px -1px rgba(5,150,105,0.3);">
          <span>🏛️</span> PTA (5G &amp; Optical)
        </button>
        <button onclick="selectRegionalTab('jazz')" id="regBtn-jazz" style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:4px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#fff;color:#475569;border:1px solid #CBD5E1;">
          <span>🔴</span> Jazz Telecom
        </button>
        <button onclick="selectRegionalTab('ptcl')" id="regBtn-ptcl" style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:4px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#fff;color:#475569;border:1px solid #CBD5E1;">
          <span>🟠</span> Ufone PTCL Group
        </button>
        <button onclick="selectRegionalTab('zong')" id="regBtn-zong" style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:4px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#fff;color:#475569;border:1px solid #CBD5E1;">
          <span>🟢</span> Zong CMPak
        </button>
      </div>

      <!-- Selected Regional Story Card -->
      <div style="background:#fff;border:1px solid #E2E8F0;border-radius:1rem;padding:2.5rem;display:grid;grid-template-columns:1fr 1fr;gap:2.5rem;align-items:center;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="height:18rem;border-radius:12px;overflow:hidden;background:#0B1120;">
          <img id="regImg" src="https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=1000&auto=format&fit=crop&q=80" alt="Regional Tech" style="width:100%;height:100%;object-fit:cover;">
        </div>
        <div>
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;">
            <span id="regCat" style="background:#D1FAE5;color:#065F46;font-size:10px;font-weight:700;padding:4px 8px;border-radius:2px;text-transform:uppercase;">TELECOM REGULATION &amp; 5G</span>
            <span id="regDate" style="font-size:12px;color:#64748B;">Aug 15, 2026 • 3 min read</span>
          </div>
          <h3 id="regTitle" style="font-size:1.375rem;font-weight:700;color:#0F172A;line-height:1.35;margin:0 0 12px;">PTA Mandates Gigabit Optical Fiber Connectivity for All Tier-1 Cellular Towers</h3>
          <p id="regSummary" style="font-size:0.875rem;color:#475569;line-height:1.7;margin:0 0 16px;">Pakistan Telecommunication Authority (PTA) enforces national fiberization directives requiring 100% of metro mobile towers to connect to high-bandwidth fiber-to-the-site (FTTS) before nationwide 5G commercial launch.</p>
          <ul id="regBullets" style="list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;">
            <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#059669;font-weight:700;">✓</span> Over 18,000 cellular towers upgraded to fiber optics</li>
            <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#059669;font-weight:700;">✓</span> Ultra-low latency sub-5ms latency across metro centers</li>
            <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#059669;font-weight:700;">✓</span> Accelerating high-speed industrial IoT deployments</li>
          </ul>
          <a id="regSourceBtn" href="https://www.pta.gov.pk/" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:#059669;text-decoration:none;">View Official Bulletin on <span id="regSourceName">PTA Portal</span> &rarr;</a>
        </div>
      </div>

    </div>
  </section>

  <!-- 5. MAIN EDITORIAL CONTENT (Don't Miss, Topic Filters, Trending & Sidebar) -->
  <section style="width:100%;padding:4.5rem 0 5.5rem;">
    <div style="max-width:80rem;margin:0 auto;padding:0 3rem;">
      <div style="display:grid;grid-template-columns:8fr 4fr;gap:3rem;align-items:start;">
        
        <!-- LEFT MAIN ARTICLES COLUMN -->
        <div style="display:flex;flex-direction:column;gap:3rem;text-align:left;">
          
          <!-- DON'T MISS SECTION -->
          <div>
            <div style="border-bottom:2px solid #030712;padding-bottom:0.5rem;margin-bottom:1.5rem;display:inline-block;">
              <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0;">Don't Miss</h3>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
              
              <!-- Card 1 -->
              <a href="blog" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;" onmouseover="this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)'">
                <div style="width:100%;height:11rem;background:linear-gradient(135deg,#111827,#1E293B,#000);display:flex;align-items:center;justify-content:center;padding:1rem;text-align:center;">
                  <div>
                    <div style="width:3rem;height:3rem;margin:0 auto 0.5rem;border-radius:8px;background:rgba(37,99,235,0.3);border:1px solid rgba(96,165,250,0.4);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                      🤖
                    </div>
                    <span style="font-size:11px;font-family:monospace;color:#67E8F9;letter-spacing:0.05em;">AI RESEARCH ARCHIVE</span>
                  </div>
                </div>
                <div style="padding:1rem;">
                  <h4 style="font-size:0.9375rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Artificial Intelligence Development from 1950 to 1965: The Foundation of Modern AI Research</h4>
                </div>
              </a>

              <!-- Card 2 -->
              <a href="blog" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;" onmouseover="this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)'">
                <div style="width:100%;height:11rem;background:linear-gradient(135deg,#064E3B,#134E4A,#0F172A);display:flex;align-items:center;justify-content:center;padding:1rem;text-align:center;">
                  <div>
                    <div style="width:3rem;height:3rem;margin:0 auto 0.5rem;border-radius:8px;background:rgba(16,185,129,0.3);border:1px solid rgba(52,211,153,0.4);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                      🌲
                    </div>
                    <span style="font-size:11px;font-family:monospace;color:#6EE7B7;letter-spacing:0.05em;">DIGITAL MARKETING</span>
                  </div>
                </div>
                <div style="padding:1rem;">
                  <h4 style="font-size:0.9375rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">WHAT ARE FACEBOOK ADS, AND HOW DOES IT WORK?</h4>
                </div>
              </a>

            </div>
          </div>

          <!-- TOPIC PILLS FILTER ROW -->
          <div>
            <div style="display:flex;align-items:center;flex-wrap:wrap;gap:8px;margin-bottom:1.5rem;">
              <span style="font-size:0.875rem;font-weight:700;color:#374151;margin-right:8px;">Discover Articles by Topic:</span>
              <button onclick="filterTopic('ALL')" id="topicBtn-ALL" style="padding:4px 12px;font-size:12px;font-weight:600;border:none;cursor:pointer;background:#0066FF;color:#fff;">ALL</button>
              <button onclick="filterTopic('SEO')" id="topicBtn-SEO" style="padding:4px 12px;font-size:12px;font-weight:600;border:none;cursor:pointer;background:#F3F4F6;color:#374151;">SEO</button>
              <button onclick="filterTopic('Hosting')" id="topicBtn-Hosting" style="padding:4px 12px;font-size:12px;font-weight:600;border:none;cursor:pointer;background:#F3F4F6;color:#374151;">Hosting</button>
              <button onclick="filterTopic('Social')" id="topicBtn-Social" style="padding:4px 12px;font-size:12px;font-weight:600;border:none;cursor:pointer;background:#F3F4F6;color:#374151;">Social</button>
              <button onclick="filterTopic('AI & Cloud')" id="topicBtn-AI & Cloud" style="padding:4px 12px;font-size:12px;font-weight:600;border:none;cursor:pointer;background:#F3F4F6;color:#374151;">AI &amp; Cloud</button>
              <button onclick="filterTopic('DevOps')" id="topicBtn-DevOps" style="padding:4px 12px;font-size:12px;font-weight:600;border:none;cursor:pointer;background:#F3F4F6;color:#374151;">DevOps</button>
            </div>

            <!-- 4 Topic Cards Grid -->
            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));gap:1.25rem;">
              
              <a href="blog" class="topic-card-item" data-topic="Hosting" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#92400E,#7C2D12,#1C1917);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#FDE68A;text-transform:uppercase;">CLOUD HOSTING</span>
                </div>
                <div style="padding:0.875rem;">
                  <h5 style="font-size:0.8125rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Why required web Hosting Service?</h5>
                </div>
              </a>

              <a href="blog" class="topic-card-item" data-topic="Social" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#B45309,#78350F,#1C1917);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#FDE68A;text-transform:uppercase;">BRAND IDENTITY</span>
                </div>
                <div style="padding:0.875rem;">
                  <h5 style="font-size:0.8125rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">What is Logo and Branding?</h5>
                </div>
              </a>

              <a href="blog" class="topic-card-item" data-topic="Hosting" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#92400E,#7C2D12,#1C1917);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#FDE68A;text-transform:uppercase;">INFRASTRUCTURE</span>
                </div>
                <div style="padding:0.875rem;">
                  <h5 style="font-size:0.8125rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Why required web Hosting Service?</h5>
                </div>
              </a>

              <a href="blog" class="topic-card-item" data-topic="Social" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#B45309,#7C2D12,#1C1917);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#FDE68A;text-transform:uppercase;">SOCIAL MEDIA</span>
                </div>
                <div style="padding:0.875rem;">
                  <h5 style="font-size:0.8125rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">What is Social Media Service?</h5>
                </div>
              </a>

            </div>
          </div>

          <!-- WHAT'S TRENDING SECTION -->
          <div>
            <div style="border-bottom:2px solid #030712;padding-bottom:0.5rem;margin-bottom:1.5rem;display:inline-block;">
              <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0;">What's Trending</h3>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));gap:1.25rem;">
              
              <!-- Trending 1 -->
              <a href="blog" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#0F172A,#111827,#000);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#67E8F9;">HISTORICAL AI</span>
                </div>
                <div style="padding:0.875rem;">
                  <h5 style="font-size:0.8125rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Artificial Intelligence Development from 1950 to 1965: The Foundation of Modern AI Research</h5>
                </div>
              </a>

              <!-- Trending 2 -->
              <a href="blog" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;display:flex;flex-direction:column;justify-content:space-between;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#EFF6FF,#EEF2FF);border-bottom:1px solid #E5E7EB;display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <svg style="width:3.5rem;height:3.5rem;color:#3B82F6;" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="1.5">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M12 3v6M12 15v6M3 12h6M15 12h6M5.6 5.6l4.2 4.2M14.2 14.2l4.2 4.2M5.6 18.4l4.2-4.2M14.2 9.8l4.2-4.2" />
                  </svg>
                </div>
                <div style="padding:0.875rem;">
                  <span style="font-size:10px;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:0.1em;display:block;margin-bottom:4px;">TRENDING</span>
                  <h5 style="font-size:0.8125rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Autonomous Multi-Agent AI Workflows</h5>
                </div>
              </a>

              <!-- Trending 3 -->
              <a href="blog" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#B45309,#7C2D12,#1C1917);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#FDE68A;">DIGITAL MARKETING</span>
                </div>
                <div style="padding:0.875rem;">
                  <h5 style="font-size:0.8125rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">HOW TO GET THE BEST DIGITAL MARKETING SERVICES?</h5>
                </div>
              </a>

              <!-- Trending 4 -->
              <a href="blog" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#064E3B,#134E4A,#0F172A);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#6EE7B7;">PAID ADVERTISING</span>
                </div>
                <div style="padding:0.875rem;">
                  <h5 style="font-size:0.8125rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">WHAT ARE FACEBOOK ADS, AND HOW DOES IT WORK?</h5>
                </div>
              </a>

            </div>
          </div>

        </div>

        <!-- RIGHT SIDEBAR COLUMN -->
        <div style="display:flex;flex-direction:column;gap:2rem;text-align:left;">
          
          <!-- WIDGET 1: TOP STORIES -->
          <div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
              <h4 style="font-size:0.875rem;font-weight:700;color:#030712;text-transform:uppercase;margin:0;">Top Stories</h4>
              <div style="display:flex;align-items:center;gap:6px;">
                <button style="width:1.5rem;height:1.5rem;background:#F3F4F6;border:1px solid #E5E7EB;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:12px;">‹</button>
                <button style="width:1.5rem;height:1.5rem;background:#F3F4F6;border:1px solid #E5E7EB;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:12px;">›</button>
              </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:1rem;">
              
              <a href="blog" style="text-decoration:none;display:flex;align-items:center;gap:12px;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#1E293B;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                  💻
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">The 7 Best Enterprise AI &amp; Cloud Laptops in 2026</h5>
                  <span style="font-size:10px;color:#9CA3AF;font-weight:600;">15-Aug-2026</span>
                </div>
              </a>

              <a href="blog" style="text-decoration:none;display:flex;align-items:center;gap:12px;padding-top:0.5rem;border-top:1px solid #F9FAFB;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                  🤖
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Autonomous Neural Security Clusters</h5>
                  <span style="font-size:10px;color:#9CA3AF;font-weight:600;">20-May-2024</span>
                </div>
              </a>

              <a href="blog" style="text-decoration:none;display:flex;align-items:center;gap:12px;padding-top:0.5rem;border-top:1px solid #F9FAFB;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#1E293B;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                  📈
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">International Growth &amp; Scaling</h5>
                  <span style="font-size:10px;color:#9CA3AF;font-weight:600;">25-Apr-2024</span>
                </div>
              </a>

            </div>
          </div>

          <!-- WIDGET 2: SPECIAL FEATURE (WATCH NOW VIDEO MODAL) -->
          <div style="background:#0B1120;color:#fff;border-radius:1rem;padding:1.5rem;position:relative;overflow:hidden;border:1px solid #1F2937;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
            <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(to right,#4ADE80,#22D3EE,#3B82F6);"></div>
            <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">Special Feature</span>
            <p style="font-size:12px;color:#D1D5DB;line-height:1.6;margin:0 0 1.25rem;">Watch our exclusive video briefings &amp; live architecture teardowns.</p>
            <button onclick="openVideoModal()" style="padding:8px 20px;background:#E53935;color:#fff;font-weight:700;font-size:12px;border:none;cursor:pointer;border-radius:2px;box-shadow:0 4px 6px -1px rgba(229,57,53,0.4);transition:background 0.2s;" onmouseover="this.style.background='#C62828'" onmouseout="this.style.background='#E53935'">Watch Now</button>
          </div>

          <!-- WIDGET 3: NEWEST VIDEOS -->
          <div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
              <h4 style="font-size:0.875rem;font-weight:700;color:#030712;text-transform:uppercase;margin:0;">Newest Videos</h4>
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
                  <span style="font-size:10px;color:#9CA3AF;font-weight:600;">25-Apr-2024</span>
                </div>
              </div>

              <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                  ▶
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">ENTERPRISE AI ARCHITECTURE</h5>
                  <span style="font-size:10px;color:#9CA3AF;font-weight:600;">18-Apr-2024</span>
                </div>
              </div>

              <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                  ▶
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">HYBRID CLOUD DEVOPS TEARDOWN</h5>
                  <span style="font-size:10px;color:#9CA3AF;font-weight:600;">12-May-2024</span>
                </div>
              </div>

            </div>
          </div>

          <!-- WIDGET 4: SPECIAL FEATURE 2 -->
          <div style="background:#0B1120;color:#fff;border-radius:1rem;padding:1.5rem;position:relative;overflow:hidden;border:1px solid #1F2937;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
            <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(to right,#FB923C,#EF4444,#EC4899);"></div>
            <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">Special Feature</span>
            <p style="font-size:12px;color:#D1D5DB;line-height:1.6;margin:0 0 1.25rem;">Explore our high-throughput AI infrastructure benchmarks.</p>
            <button onclick="openVideoModal()" style="padding:8px 20px;background:#E53935;color:#fff;font-weight:700;font-size:12px;border:none;cursor:pointer;border-radius:2px;box-shadow:0 4px 6px -1px rgba(229,57,53,0.4);transition:background 0.2s;" onmouseover="this.style.background='#C62828'" onmouseout="this.style.background='#E53935'">Watch Now</button>
          </div>

          <!-- WIDGET 5: UPCOMING EVENTS -->
          <div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
              <h4 style="font-size:0.875rem;font-weight:700;color:#030712;text-transform:uppercase;margin:0;">Upcoming Events</h4>
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
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">International Conference on World Cloud Architecture</h5>
                  <span style="font-size:10px;color:#9CA3AF;font-weight:600;">25-Apr-2026</span>
                </div>
              </div>

              <div onclick="openEventModal('Global AI & Autonomous Agents Summit 2026')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
                <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
                  <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">28</span>
                  <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">MAY</span>
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Global AI &amp; Autonomous Agents Summit 2026</h5>
                  <span style="font-size:10px;color:#9CA3AF;font-weight:600;">28-May-2026</span>
                </div>
              </div>

              <div onclick="openEventModal('Enterprise Cybersecurity & Threat Modeling Workshop')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
                <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
                  <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">15</span>
                  <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">JUN</span>
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Enterprise Cybersecurity &amp; Threat Modeling Workshop</h5>
                  <span style="font-size:10px;color:#9CA3AF;font-weight:600;">15-Jun-2026</span>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- 6. CLEAN ARTICLE REVIEWS / REFERENCES CAROUSEL SECTION -->
  <section style="width:100%;background:#fff;padding:5rem 0;border-top:1px solid #E5E7EB;position:relative;" id="reviewCarouselSection">
    <div style="max-width:64rem;margin:0 auto;padding:0 2rem;">
      
      <div style="text-align:center;margin-bottom:3.5rem;">
        <span style="font-size:11px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.15em;display:block;margin-bottom:8px;">References</span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:600;color:#030712;letter-spacing:-0.02em;max-width:42rem;margin:0 auto;line-height:1.3;">
          Read what our clients and colleagues have to say about our work.
        </h2>
      </div>

      <!-- Reviews Container -->
      <div id="reviewsContainer" style="display:flex;flex-direction:column;gap:1.5rem;min-height:380px;transition:opacity 0.4s ease;">
        <!-- Injected via JavaScript -->
      </div>

      <!-- Pagination Indicators -->
      <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:2.5rem;">
        <button onclick="goToReviewPage(0)" id="revDot-0" style="width:2rem;height:4px;border-radius:2px;border:none;background:#0052FF;cursor:pointer;transition:all 0.3s;"></button>
        <button onclick="goToReviewPage(1)" id="revDot-1" style="width:1rem;height:4px;border-radius:2px;border:none;background:#D1D5DB;cursor:pointer;transition:all 0.3s;"></button>
      </div>

    </div>
  </section>

</div>

<!-- 7. VIDEO POPUP MODAL -->
<div id="videoModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.85);backdrop-filter:blur(8px);z-index:9999;align-items:center;justify-content:center;padding:1rem;">
  <div style="background:#0B1120;border:1px solid #1F2937;max-width:48rem;width:100%;padding:1.5rem;box-shadow:0 25px 50px -12px rgba(0,0,0,0.7);position:relative;border-radius:8px;">
    <button onclick="closeVideoModal()" style="position:absolute;top:1rem;right:1rem;background:transparent;border:none;color:#fff;font-size:1.25rem;cursor:pointer;font-weight:700;" onmouseover="this.style.color='#0052FF'" onmouseout="this.style.color='#fff'">✕</button>
    <span style="font-size:10px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.1em;">LIVE STREAM</span>
    <h3 style="font-size:1.25rem;font-weight:700;color:#fff;margin:4px 0 1rem;">Video Intelligence Briefing</h3>
    <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;background:#000;border-radius:4px;">
      <iframe src="https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ?autoplay=1" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
</div>

<!-- 8. EVENT REGISTRATION MODAL -->
<div id="eventModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.8);backdrop-filter:blur(8px);z-index:9999;align-items:center;justify-content:center;padding:1rem;">
  <div style="background:#fff;border:1px solid #E5E7EB;max-width:32rem;width:100%;padding:2rem;box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);position:relative;border-radius:12px;text-align:left;">
    <button onclick="closeEventModal()" style="position:absolute;top:1rem;right:1rem;background:transparent;border:none;color:#6B7280;font-size:1.25rem;cursor:pointer;font-weight:700;" onmouseover="this.style.color='#0052FF'" onmouseout="this.style.color='#6B7280'">✕</button>
    <span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;">EVENT REGISTRATION</span>
    <h3 id="modalEventTitle" style="font-size:1.25rem;font-weight:700;color:#0F172A;margin:6px 0 8px;">Event Name</h3>
    <p style="font-size:12px;color:#64748B;line-height:1.6;margin:0 0 1.5rem;">Register your engineering team for reserved VIP seating and access to live technical workshops and keynote recordings.</p>
    
    <form onsubmit="handleEventRegister(event)" style="display:flex;flex-direction:column;gap:12px;">
      <input type="text" required placeholder="Full Name" style="width:100%;padding:10px 14px;border:1px solid #CBD5E1;font-size:13px;border-radius:4px;outline:none;box-sizing:border-box;">
      <input type="email" required placeholder="Work Email" style="width:100%;padding:10px 14px;border:1px solid #CBD5E1;font-size:13px;border-radius:4px;outline:none;box-sizing:border-box;">
      <input type="text" required placeholder="Company / Role" style="width:100%;padding:10px 14px;border:1px solid #CBD5E1;font-size:13px;border-radius:4px;outline:none;box-sizing:border-box;">
      <button type="submit" style="width:100%;padding:12px;background:#0052FF;color:#fff;font-weight:700;font-size:12px;text-transform:uppercase;letter-spacing:0.05em;border:none;border-radius:4px;cursor:pointer;margin-top:6px;transition:background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">Reserve Free VIP Pass</button>
    </form>
  </div>
</div>

<!-- JAVASCRIPT: Full State Machine & Interactive Controllers -->
<script>
// 1. LATEST IT STORIES DATA
var IT_STORIES = [
  {
    category: 'TECHCRUNCH ENTERPRISE',
    source: '🌐 TechCrunch',
    date: 'Aug 15, 2026',
    time: '4 min read',
    title: 'Talks to sell PayPal to Stripe and Advent are heating up',
    summary: "PayPal is reportedly negotiating a potential sale to Stripe and private equity firm Advent, as the fintech firm's new CEO attempts to accelerate enterprise payment rails.",
    bullets: [
      'Multi-billion dollar transactional rails consolidation',
      'High-throughput global API gateway synergies',
      'Accelerating cross-border enterprise settlement speed'
    ],
    image: 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?w=1200&auto=format&fit=crop&q=80',
    link: 'https://techcrunch.com/category/enterprise/'
  },
  {
    category: 'CREED TECH PRESS',
    source: '🚀 Creed Tech Systems',
    date: 'Aug 15, 2026',
    time: '5 min read',
    title: 'Creed Tech Launches Autonomous Multi-Agent Cloud Infrastructure for Enterprise Clients',
    summary: 'Our engineering squad deploys sovereign air-gapped neural agent clusters that automate Kubernetes microservices, test suite generation, and cryptographic telemetry.',
    bullets: [
      '3.2x faster continuous deployment sprint cycles',
      'Zero-downtime containerized microservices orchestration',
      'Air-gapped on-premise privacy with zero data leakage'
    ],
    image: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1200&auto=format&fit=crop&q=80',
    link: 'blog'
  },
  {
    category: 'QUANTUM CRYPTOGRAPHY',
    source: '⚡ Reuters Tech',
    date: 'Aug 14, 2026',
    time: '3 min read',
    title: 'Post-Quantum Lattice Encryption Formally Standardized for Global Banking Rails',
    summary: 'International central banks and payment institutions mandate post-quantum lattice cryptography to secure financial transactions against emerging quantum computing capabilities.',
    bullets: [
      'NIST Level 5 lattice-based cryptographic algorithms',
      'Sub-millisecond verification latency across trading desks',
      'Full backward compatibility with existing TLS infrastructure'
    ],
    image: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=1200&auto=format&fit=crop&q=80',
    link: 'blog'
  }
];

function selectITStory(idx) {
  var s = IT_STORIES[idx];
  if (!s) return;

  [0,1,2].forEach(function(i) {
    var c = document.getElementById('itStoryCard-' + i);
    if (!c) return;
    if (i === idx) {
      c.style.border = '2px solid #0052FF';
      c.style.boxShadow = '0 4px 6px -1px rgba(0,82,255,0.15)';
    } else {
      c.style.border = '1px solid #E2E8F0';
      c.style.boxShadow = 'none';
    }
  });

  document.getElementById('itLeadImg').src = s.image;
  document.getElementById('itLeadCat').textContent = s.category;
  document.getElementById('itLeadSource').textContent = s.source;
  document.getElementById('itLeadDate').textContent = s.date;
  document.getElementById('itLeadTime').textContent = s.time;
  document.getElementById('itLeadTitle').textContent = s.title;
  document.getElementById('itLeadSummary').textContent = s.summary;
  document.getElementById('itLeadBtn').href = s.link;
  
  var bulletsHtml = s.bullets.map(function(b) {
    return '<li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#0052FF;font-weight:700;">✓</span> ' + b + '</li>';
  }).join('');
  document.getElementById('itLeadBullets').innerHTML = bulletsHtml;
}

// 2. BIG TECH WIRE DATA
var BIG_TECH_WIRE = {
  'google': {
    category: 'GOOGLE QUANTUM & AI',
    date: 'Aug 15, 2026 • 3 min read',
    title: 'Google Quantum AI Achieves Major Error Reduction Milestone on Willow Processor',
    summary: 'Google researchers demonstrate scalable fault-tolerant quantum operations, reducing logical error rates exponentially with increased physical qubit count.',
    bullets: [
      'Sub-threshold quantum error correction verified',
      'Willow chip architecture delivers 105 physical qubits',
      'Direct integration with Google Cloud TPU clusters'
    ],
    image: 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=1000&auto=format&fit=crop&q=80',
    sourceUrl: 'https://blog.google/technology/ai/',
    sourceName: 'Google The Keyword'
  },
  'openai': {
    category: 'REASONING MODELS',
    date: 'Aug 15, 2026 • 4 min read',
    title: 'OpenAI Announces Autonomous Frontier Multi-Step Problem Solving Frameworks',
    summary: 'New agentic reasoning architecture enables AI models to perform complex software engineering, scientific synthesis, and mathematical proof validation autonomously.',
    bullets: [
      'Chain-of-thought verification with tree search execution',
      '89.4% accuracy on competitive software engineering benchmarks',
      'Enterprise air-gapped security guardrails'
    ],
    image: 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=1000&auto=format&fit=crop&q=80',
    sourceUrl: 'https://openai.com/news/',
    sourceName: 'OpenAI Newsroom'
  },
  'microsoft': {
    category: 'AZURE CLOUD INFRA',
    date: 'Aug 14, 2026 • 4 min read',
    title: 'Microsoft Deploys Next-Gen Optical Interconnects for 100k GPU Superclusters',
    summary: 'Azure engineering rolls out co-packaged optics across hyperscale data centers, cutting inter-node communication latency by 45% for frontier AI training.',
    bullets: [
      '800 Gbps silicon photonics transceivers per server blade',
      '30% lower data center cooling energy consumption',
      'Seamless multi-region distributed model parallelism'
    ],
    image: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=1000&auto=format&fit=crop&q=80',
    sourceUrl: 'https://news.microsoft.com/',
    sourceName: 'Microsoft Stories'
  },
  'nvidia': {
    category: 'SILICON ARCHITECTURE',
    date: 'Aug 14, 2026 • 5 min read',
    title: 'NVIDIA Expands High-Density NVLink 6 Fabric for Exascale AI Factories',
    summary: 'Next-generation NVLink switches deliver 3.6 TB/s all-to-all bidirectional bandwidth per GPU, accelerating trillion-parameter model inference pipelines.',
    bullets: [
      '3.6 TB/s bidirectional high-bandwidth interconnects',
      'Liquid-cooled rack-scale system engineering',
      'Hardware-accelerated confidential computing enclave'
    ],
    image: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?w=1000&auto=format&fit=crop&q=80',
    sourceUrl: 'https://nvidianews.nvidia.com/',
    sourceName: 'NVIDIA Newsroom'
  },
  'apple': {
    category: 'ON-DEVICE NEURAL SILICON',
    date: 'Aug 13, 2026 • 3 min read',
    title: 'Apple Silicon M5 Architecture Integrates Unified Neural Matrix Engine',
    summary: 'Apple details revolutionary 3nm silicon architecture with on-die unified memory architecture dedicated exclusively to local LLM context execution.',
    bullets: [
      '128 GB/s unified neural bus bandwidth',
      'Private cloud compute cryptographic validation',
      'Instant zero-latency on-device token generation'
    ],
    image: 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=1000&auto=format&fit=crop&q=80',
    sourceUrl: 'https://www.apple.com/newsroom/',
    sourceName: 'Apple Newsroom'
  }
};

function selectWireBrand(brand) {
  var b = BIG_TECH_WIRE[brand];
  if (!b) return;

  ['google','openai','microsoft','nvidia','apple'].forEach(function(k) {
    var btn = document.getElementById('wireBtn-' + k);
    if (!btn) return;
    if (k === brand) {
      btn.style.background = '#0052FF';
      btn.style.color = '#fff';
      btn.style.boxShadow = '0 4px 6px -1px rgba(0,82,255,0.3)';
    } else {
      btn.style.background = '#F1F5F9';
      btn.style.color = '#475569';
      btn.style.boxShadow = 'none';
    }
  });

  document.getElementById('wireImg').src = b.image;
  document.getElementById('wireCat').textContent = b.category;
  document.getElementById('wireDate').textContent = b.date;
  document.getElementById('wireTitle').textContent = b.title;
  document.getElementById('wireSummary').textContent = b.summary;
  document.getElementById('wireSourceBtn').href = b.sourceUrl;
  document.getElementById('wireSourceName').textContent = b.sourceName;

  var bulletsHtml = b.bullets.map(function(item) {
    return '<li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#0052FF;font-weight:700;">✓</span> ' + item + '</li>';
  }).join('');
  document.getElementById('wireBullets').innerHTML = bulletsHtml;
}

// 3. REGIONAL TECH WIRE DATA
var REGIONAL_WIRE = {
  'pta': {
    category: 'TELECOM REGULATION & 5G',
    date: 'Aug 15, 2026 • 3 min read',
    title: 'PTA Mandates Gigabit Optical Fiber Connectivity for All Tier-1 Cellular Towers',
    summary: 'Pakistan Telecommunication Authority (PTA) enforces national fiberization directives requiring 100% of metro mobile towers to connect to high-bandwidth fiber-to-the-site (FTTS) before nationwide 5G commercial launch.',
    bullets: [
      'Over 18,000 cellular towers upgraded to fiber optics',
      'Ultra-low latency sub-5ms latency across metro centers',
      'Accelerating high-speed industrial IoT deployments'
    ],
    image: 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=1000&auto=format&fit=crop&q=80',
    sourceUrl: 'https://www.pta.gov.pk/',
    sourceName: 'PTA Official Portal'
  },
  'jazz': {
    category: 'DIGITAL ECOSYSTEM',
    date: 'Aug 15, 2026 • 4 min read',
    title: 'Jazz Surpasses 45 Million 4G Subscribers with Heavy Cloud Data Center Expansion',
    summary: 'Jazz expands its multi-cloud Tier-3 data center infrastructure in Islamabad and Karachi to support enterprise banking APIs, JazzCash transaction processing, and sovereign cloud compute.',
    bullets: [
      '45M+ active 4G data subscribers across Pakistan',
      'Tier-3 hyperscale data center footprint expansion',
      'Direct peering with international cloud service providers'
    ],
    image: 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=1000&auto=format&fit=crop&q=80',
    sourceUrl: 'https://jazz.com.pk/media-center',
    sourceName: 'Jazz Media Center'
  },
  'ptcl': {
    category: 'FIBER & BROADBAND',
    date: 'Aug 14, 2026 • 4 min read',
    title: 'PTCL Group Deploys Subsea Cable AAE-1 Optical Capacity Upgrade for High-Speed Internet',
    summary: 'PTCL Group successfully lights up additional multi-terabit subsea optical bandwidth on the AAE-1 and SMW-5 submarine cable systems, enhancing international latency for Pakistani software exporters.',
    bullets: [
      '12 Terabits/sec added to Pakistan international gateway',
      '30% latency reduction to European cloud data centers',
      'Redundant subsea landing station resilience in Karachi'
    ],
    image: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=1000&auto=format&fit=crop&q=80',
    sourceUrl: 'https://www.ptcl.com.pk/',
    sourceName: 'PTCL Group Press'
  },
  'zong': {
    category: '5G NETWORK TRIALS',
    date: 'Aug 14, 2026 • 5 min read',
    title: 'Zong CMPak Tests 1.8 Gbps Peak Throughput in Dedicated Industrial 5G Testbed',
    summary: 'Zong CMPak achieves commercial-grade gigabit download throughput in smart port and manufacturing trial zones in partnership with multinational industrial automation firms.',
    bullets: [
      '1.8 Gbps peak standalone 5G throughput verified',
      'Smart port automated crane telemetry operational',
      'Private enterprise mmWave network slicing trials'
    ],
    image: 'https://images.unsplash.com/photo-1508873696983-2df5293cb32f?w=1000&auto=format&fit=crop&q=80',
    sourceUrl: 'https://www.zong.com.pk/',
    sourceName: 'Zong News Center'
  }
};

function selectRegionalTab(tab) {
  var r = REGIONAL_WIRE[tab];
  if (!r) return;

  ['pta','jazz','ptcl','zong'].forEach(function(k) {
    var btn = document.getElementById('regBtn-' + k);
    if (!btn) return;
    if (k === tab) {
      btn.style.background = '#059669';
      btn.style.color = '#fff';
      btn.style.border = 'none';
      btn.style.boxShadow = '0 4px 6px -1px rgba(5,150,105,0.3)';
    } else {
      btn.style.background = '#fff';
      btn.style.color = '#475569';
      btn.style.border = '1px solid #CBD5E1';
      btn.style.boxShadow = 'none';
    }
  });

  document.getElementById('regImg').src = r.image;
  document.getElementById('regCat').textContent = r.category;
  document.getElementById('regDate').textContent = r.date;
  document.getElementById('regTitle').textContent = r.title;
  document.getElementById('regSummary').textContent = r.summary;
  document.getElementById('regSourceBtn').href = r.sourceUrl;
  document.getElementById('regSourceName').textContent = r.sourceName;

  var bulletsHtml = r.bullets.map(function(item) {
    return '<li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#334155;"><span style="color:#059669;font-weight:700;">✓</span> ' + item + '</li>';
  }).join('');
  document.getElementById('regBullets').innerHTML = bulletsHtml;
}

// 4. TOPIC FILTER
function filterTopic(topic) {
  ['ALL','SEO','Hosting','Social','AI & Cloud','DevOps'].forEach(function(t) {
    var btn = document.getElementById('topicBtn-' + t);
    if (!btn) return;
    if (t === topic) {
      btn.style.background = '#0066FF';
      btn.style.color = '#fff';
    } else {
      btn.style.background = '#F3F4F6';
      btn.style.color = '#374151';
    }
  });

  var cards = document.querySelectorAll('.topic-card-item');
  cards.forEach(function(c) {
    var t = c.getAttribute('data-topic');
    if (topic === 'ALL' || t === topic) {
      c.style.display = 'block';
    } else {
      c.style.display = 'none';
    }
  });
}

// 5. CLIENT REVIEWS ROTATING CAROUSEL
var REVIEWS_DATA = [
  // Page 0
  [
    {
      name: 'Vlad Hryhoren',
      role: 'HiRefresh Agency / UX/UI Designer',
      avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80',
      quote: "It's always a pleasure working with Creed Tech, they are exceptional at communicating and delivering results. They bring 100% engineering rigor to each milestone and get mission-critical work done when it's needed the most."
    },
    {
      name: 'Jonathan Anastas',
      role: 'Ador Network Services / Chief Marketing Officer',
      avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=180&auto=format&fit=crop&q=80',
      quote: "We engaged Creed Tech with the goal of scaling our high-throughput transactional infrastructure. Their team was extraordinary in orchestrating zero-downtime microservices and cloud automation. If you want top-tier engineering maturity, look no further."
    },
    {
      name: 'Alex Linetski',
      role: 'HiRefresh Agency / Lead Developer',
      avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=180&auto=format&fit=crop&q=80',
      quote: "Creed Tech has an amazing team of principal engineers. They have a deep, practical understanding of modern cloud ecosystems, AI pipelines, and deliver rock-solid results on every sprint."
    }
  ],
  // Page 1
  [
    {
      name: 'Dr. Marcus Vance',
      role: 'Head of Enterprise Engineering / CloudMatrix',
      avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=180&auto=format&fit=crop&q=80',
      quote: "Their technical whitepapers and architecture benchmarks saved our core banking engineering department weeks of trial and error. Deep architectural mastery with flawless implementation."
    },
    {
      name: 'Elena Rostova',
      role: 'AI Product Lead / Cognitive Health',
      avatar: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=180&auto=format&fit=crop&q=80',
      quote: "Crystal-clear documentation, transparent code audits, and proactive communication. Finding rigorously tested enterprise AI and data synchronization capabilities like this is extraordinarily rare."
    },
    {
      name: 'Sarah Jenkins',
      role: 'Chief Security Officer / FinEdge Global',
      avatar: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=180&auto=format&fit=crop&q=80',
      quote: "Creed Tech rebuilt our core payments processing cluster with automated SOC 2 and ISO 27001 audit logging. Zero vulnerabilities and unmatched deployment speed."
    }
  ]
];

var curReviewPage = 0;
var reviewTimer = null;
var isPaused = false;

function renderReviews(page) {
  var container = document.getElementById('reviewsContainer');
  if (!container) return;

  var items = REVIEWS_DATA[page];
  if (!items) return;

  container.style.opacity = '0';
  setTimeout(function() {
    container.innerHTML = items.map(function(r) {
      return '<div style="display:flex;align-items:flex-start;gap:1.5rem;background:#F9FAFB;padding:1.5rem;border-radius:12px;border:1px solid #F3F4F6;">' +
        '<img src="' + r.avatar + '" alt="' + r.name + '" style="width:3.5rem;height:3.5rem;border-radius:50%;object-fit:cover;flex-shrink:0;border:2px solid #E5E7EB;">' +
        '<div>' +
          '<div style="margin-bottom:6px;">' +
            '<h4 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 2px;">' + r.name + '</h4>' +
            '<span style="font-size:12px;color:#6B7280;font-weight:500;">' + r.role + '</span>' +
          '</div>' +
          '<p style="font-size:0.875rem;color:#374151;line-height:1.65;margin:0;font-style:italic;">&ldquo;' + r.quote + '&rdquo;</p>' +
        '</div>' +
      '</div>';
    }).join('');
    container.style.opacity = '1';
  }, 200);

  // Update dots
  [0, 1].forEach(function(p) {
    var dot = document.getElementById('revDot-' + p);
    if (!dot) return;
    if (p === page) {
      dot.style.width = '2rem';
      dot.style.background = '#0052FF';
    } else {
      dot.style.width = '1rem';
      dot.style.background = '#D1D5DB';
    }
  });
}

function goToReviewPage(page) {
  curReviewPage = page;
  renderReviews(curReviewPage);
}

function startReviewAutoRotate() {
  if (reviewTimer) clearInterval(reviewTimer);
  reviewTimer = setInterval(function() {
    if (!isPaused) {
      curReviewPage = (curReviewPage + 1) % REVIEWS_DATA.length;
      renderReviews(curReviewPage);
    }
  }, 6000);
}

// 6. MODALS
function openVideoModal() {
  document.getElementById('videoModal').style.display = 'flex';
}
function closeVideoModal() {
  document.getElementById('videoModal').style.display = 'none';
}

function openEventModal(eventTitle) {
  document.getElementById('modalEventTitle').textContent = eventTitle;
  document.getElementById('eventModal').style.display = 'flex';
}
function closeEventModal() {
  document.getElementById('eventModal').style.display = 'none';
}

function handleEventRegister(e) {
  e.preventDefault();
  alert('Registration confirmed! We have emailed your event access pass.');
  closeEventModal();
}

// DOM Ready
document.addEventListener('DOMContentLoaded', function() {
  renderReviews(0);
  startReviewAutoRotate();

  var sec = document.getElementById('reviewCarouselSection');
  if (sec) {
    sec.addEventListener('mouseenter', function() { isPaused = true; });
    sec.addEventListener('mouseleave', function() { isPaused = false; });
  }
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
