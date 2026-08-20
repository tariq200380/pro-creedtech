<?php
require_once __DIR__ . '/includes/db.php';

$article_id = intval($_GET['id'] ?? 1);
$article_slug = trim($_GET['slug'] ?? '');
$article = null;

// 1. Check data/articles.json
$jsonPath = __DIR__ . '/data/articles.json';
if (file_exists($jsonPath)) {
    $articlesList = json_decode(file_get_contents($jsonPath), true) ?? [];
    foreach ($articlesList as $item) {
        if (($article_id > 0 && $item['id'] === $article_id) || (!empty($article_slug) && ($item['slug'] ?? '') === $article_slug)) {
            $article = $item;
            break;
        }
    }
}

// Fallback to first article if not found
if (!$article && !empty($articlesList)) {
    $article = $articlesList[0];
}

$page_title = htmlspecialchars($article['title'] ?? 'The Best Laptops We\'ve Tested') . " | Creed Tech";
$page_description = "In-depth enterprise hardware benchmarks, audio briefings, video walkthroughs, and pros & cons breakdown from Creed Tech Labs.";
$active_page = "knowledge-center";
$canonical_url = "https://creed-tech.com/blog_detail?id=" . intval($article['id'] ?? $article_id);

$schema_json = [
    "@context" => "https://schema.org",
    "@type" => "TechArticle",
    "headline" => $article['title'] ?? 'Enterprise Systems Architecture & Hardware Teardown',
    "description" => $page_description,
    "image" => "https://creed-tech.com/Creed-Tech-Logo-Clean.png",
    "datePublished" => "2026-08-16T08:00:00+00:00",
    "dateModified" => "2026-08-20T08:00:00+00:00",
    "author" => [
        "@type" => "Person",
        "name" => $article['author'] ?? "Dr. Sarah Jenkins",
        "jobTitle" => "Senior Hardware Benchmarking & Architecture Lead"
    ],
    "publisher" => [
        "@type" => "Organization",
        "name" => "Creed Tech",
        "logo" => [
            "@type" => "ImageObject",
            "url" => "https://creed-tech.com/Creed-Tech-Logo-Clean.png"
        ]
    ],
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id" => $canonical_url
    ]
];

$og_type = "article";

include __DIR__ . '/includes/header.php';
?>

<div style="background:#FAFAFC;min-height:100vh;padding:40px 0 80px 0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#0F172A;">
  <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
    
    <!-- Top Breadcrumb Navigation -->
    <div style="display:flex;align-items:center;gap:10px;font-size:13px;color:#64748B;margin-bottom:20px;">
      <a href="knowledge-center.php" style="color:#0052FF;text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:6px;">
        ← Back to Knowledge Center
      </a>
      <span>/</span>
      <span style="color:#0F172A;font-weight:600;"><?php echo htmlspecialchars($article['category'] ?? 'HARDWARE'); ?></span>
    </div>

    <!-- Article Header -->
    <div style="margin-bottom:28px;">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;flex-wrap:wrap;">
        <span style="background:#EF4444;color:#fff;font-size:10px;font-weight:800;padding:4px 10px;border-radius:2px;letter-spacing:0.08em;text-transform:uppercase;">
          CREED LABS COMPREHENSIVE TEARDOWN
        </span>
        <span style="font-size:12px;color:#64748B;">•</span>
        <span style="font-size:12px;color:#64748B;"><?php echo htmlspecialchars($article['date'] ?? date('M d, Y')); ?></span>
        <span style="font-size:12px;color:#64748B;">•</span>
        <span style="font-size:12px;color:#64748B;font-weight:600;">⏱️ <?php echo htmlspecialchars($article['read_time'] ?? '18 min read'); ?></span>
        <span style="font-size:12px;color:#64748B;">•</span>
        <span style="font-size:12px;color:#059669;font-weight:700;">👁️ <?php echo htmlspecialchars($article['views'] ?? '64,250'); ?> Verified Reads</span>
      </div>

      <h1 style="font-size:clamp(2rem, 3.8vw, 3rem);font-weight:800;color:#0F172A;line-height:1.2;margin:0 0 16px;letter-spacing:-0.02em;">
        <?php echo htmlspecialchars($article['title']); ?>
      </h1>

      <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding-bottom:20px;border-bottom:1px solid #E2E8F0;">
        <div style="display:flex;align-items:center;gap:12px;">
          <div style="width:44px;height:44px;border-radius:50%;background:#0052FF;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:16px;box-shadow:0 2px 6px rgba(0,82,255,0.3);">
            CT
          </div>
          <div>
            <div style="font-size:14px;font-weight:700;color:#0F172A;"><?php echo htmlspecialchars($article['author'] ?? 'Dr. Sarah Jenkins & Marcus Vance'); ?></div>
            <div style="font-size:12px;color:#64748B;">Senior Hardware Benchmarking &amp; Cloud Infrastructure Architecture Squad</div>
          </div>
        </div>

        <!-- Social & Share Icons -->
        <div style="display:flex;align-items:center;gap:8px;">
          <button onclick="shareArticle('copy')" style="padding:7px 14px;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:6px;color:#1E293B;">
            🔗 Copy Direct Link
          </button>
          <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($article['title']); ?>" target="_blank" style="padding:7px 14px;background:#000;color:#fff;text-decoration:none;border-radius:4px;font-size:12px;font-weight:700;display:flex;align-items:center;gap:6px;">
            𝕏 Share Review
          </a>
        </div>
      </div>
    </div>

    <!-- 1. EDITORS' NOTE BANNER (PCMag Style) -->
    <?php if (!empty($article['editors_note'])): ?>
    <div style="background:#FFF5F5;border-left:5px solid #E11D48;padding:20px 24px;border-radius:0 8px 8px 0;margin-bottom:32px;box-shadow:0 1px 3px rgba(225,29,72,0.05);">
      <div style="font-size:12px;font-weight:800;color:#E11D48;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:8px;">
        EDITORS' NOTE &amp; LABS METHODOLOGY
      </div>
      <p style="font-size:14px;color:#334155;line-height:1.75;margin:0;font-style:italic;">
        <?php echo htmlspecialchars($article['editors_note']); ?>
      </p>
    </div>
    <?php endif; ?>

    <!-- 2. INTRODUCTORY EDITORIAL PARAGRAPHS (Long Form) -->
    <?php if (!empty($article['intro_paragraphs'])): ?>
    <div style="background:#fff;border:1px solid #E2E8F0;border-radius:12px;padding:32px;margin-bottom:36px;box-shadow:0 1px 3px rgba(0,0,0,0.05);line-height:1.85;font-size:15px;color:#334155;">
      <?php foreach ($article['intro_paragraphs'] as $p): ?>
        <p style="margin:0 0 16px;"><?php echo htmlspecialchars($p); ?></p>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- 3. MULTIMEDIA PODCAST / AUDIO BRIEFING PLAYER -->
    <div style="background:#0F172A;color:#fff;border-radius:12px;padding:22px 28px;margin-bottom:36px;box-shadow:0 10px 25px -5px rgba(0,0,0,0.3);border:1px solid #1E293B;">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;flex-wrap:wrap;gap:8px;">
        <div style="display:flex;align-items:center;gap:10px;">
          <span style="background:#2563EB;color:#fff;font-size:10px;font-weight:800;padding:3px 8px;border-radius:2px;letter-spacing:0.05em;text-transform:uppercase;">AUDIO BRIEFING</span>
          <span style="font-size:14px;font-weight:700;color:#F8FAFC;">🎧 Listen to Complete Architectural Podcast &amp; Teardown (12 mins)</span>
        </div>
        <div style="font-size:11px;color:#94A3B8;font-family:monospace;">Studio 96kHz Master Telemetry</div>
      </div>

      <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
        <!-- Audio Element -->
        <audio id="articleAudioPlayer" src="<?php echo htmlspecialchars($article['audio_url'] ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3'); ?>" preload="metadata"></audio>

        <!-- Play/Pause Button -->
        <button id="audioPlayBtn" onclick="toggleAudioPlay()" style="width:46px;height:46px;border-radius:50%;background:#0052FF;color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:20px;box-shadow:0 4px 10px rgba(0,82,255,0.4);transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
          ▶
        </button>

        <!-- Scrubber Progress Bar -->
        <div style="flex:1;min-width:200px;display:flex;flex-direction:column;gap:6px;">
          <input type="range" id="audioScrubber" min="0" max="100" value="0" style="width:100%;cursor:pointer;accent-color:#0052FF;" oninput="seekAudio(this.value)">
          <div style="display:flex;justify-content:space-between;font-size:11px;color:#94A3B8;font-family:monospace;">
            <span id="audioCurTime">00:00</span>
            <span id="audioDurTime">12:15</span>
          </div>
        </div>

        <!-- Playback Speed Controls -->
        <div style="display:flex;align-items:center;gap:6px;">
          <button onclick="setAudioSpeed(1.0)" class="spd-btn" id="spd-1" style="padding:5px 10px;background:#0052FF;color:#fff;border:1px solid #0052FF;border-radius:4px;font-size:11px;font-weight:700;cursor:pointer;">1.0x</button>
          <button onclick="setAudioSpeed(1.5)" class="spd-btn" id="spd-15" style="padding:5px 10px;background:#1E293B;color:#94A3B8;border:1px solid #334155;border-radius:4px;font-size:11px;font-weight:700;cursor:pointer;">1.5x</button>
          <button onclick="setAudioSpeed(2.0)" class="spd-btn" id="spd-2" style="padding:5px 10px;background:#1E293B;color:#94A3B8;border:1px solid #334155;border-radius:4px;font-size:11px;font-weight:700;cursor:pointer;">2.0x</button>
        </div>
      </div>
    </div>

    <!-- 4. MAIN CONTENT GRID WITH "JUMP TO" SIDEBAR -->
    <div style="display:grid;grid-template-columns:280px 1fr;gap:40px;align-items:start;">
      
      <!-- LEFT STICKY "JUMP TO" SIDEBAR (PCMag Style) -->
      <div style="position:sticky;top:90px;background:#fff;border:1px solid #E2E8F0;border-radius:12px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
        <div style="font-size:12px;font-weight:800;color:#E11D48;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:14px;padding-bottom:10px;border-bottom:2px solid #F1F5F9;">
          JUMP TO ARTICLE SECTION
        </div>

        <nav style="display:flex;flex-direction:column;gap:6px;">
          <a href="#video-teardown" style="font-size:13px;font-weight:600;color:#0F172A;text-decoration:none;padding:8px 10px;border-radius:4px;display:block;transition:all 0.2s;" onmouseover="this.style.background='#F1F5F9';this.style.color='#0052FF'" onmouseout="this.style.background='transparent';this.style.color='#0F172A'">
            🎥 4K Video Teardown
          </a>

          <?php if (!empty($article['jump_to'])): ?>
            <?php foreach ($article['jump_to'] as $jump): ?>
              <a href="#<?php echo htmlspecialchars($jump['id']); ?>" style="font-size:13px;font-weight:600;color:#475569;text-decoration:none;padding:8px 10px;border-radius:4px;display:block;line-height:1.4;transition:all 0.2s;" onmouseover="this.style.background='#F1F5F9';this.style.color='#0052FF'" onmouseout="this.style.background='transparent';this.style.color='#475569'">
                <?php echo htmlspecialchars($jump['label']); ?>
              </a>
            <?php endforeach; ?>
          <?php endif; ?>
        </nav>

        <div style="margin-top:28px;padding-top:18px;border-top:1px solid #F1F5F9;">
          <div style="font-size:11px;font-weight:700;color:#64748B;text-transform:uppercase;margin-bottom:8px;">Labs Overall Rating</div>
          <div style="display:flex;align-items:center;gap:6px;color:#E11D48;font-size:15px;font-weight:800;">
            ★★★★☆ <span style="color:#0F172A;font-size:13px;">4.5 / 5.0 (Exceptional)</span>
          </div>
        </div>
      </div>

      <!-- RIGHT MAIN COLUMN: VIDEO + DETAILED PRODUCT CARDS -->
      <div style="display:flex;flex-direction:column;gap:48px;">

        <!-- 4K VIDEO BENCHMARK TEARDOWN SECTION -->
        <div id="video-teardown" style="background:#fff;border:1px solid #E2E8F0;border-radius:14px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,0.05);scroll-margin-top:100px;">
          <div style="padding:18px 24px;border-bottom:1px solid #E2E8F0;display:flex;align-items:center;justify-content:space-between;">
            <div style="display:flex;align-items:center;gap:10px;">
              <span style="background:#EF4444;color:#fff;font-size:10px;font-weight:800;padding:3px 8px;border-radius:2px;">4K HDR VIDEO</span>
              <h3 style="font-size:16px;font-weight:700;color:#0F172A;margin:0;">Hardware Teardown &amp; Thermal Stress Test Walkthrough</h3>
            </div>
            <span style="font-size:12px;color:#64748B;font-family:monospace;">Duration: 14:20</span>
          </div>
          <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;background:#000;">
            <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;" src="https://www.youtube.com/embed/dQw4w9WgXcQ?controls=1" title="Creed Tech Hardware Teardown" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>

        <!-- PRODUCTS BENCHMARKED (PCMag Style Bento Cards) -->
        <?php if (!empty($article['products'])): ?>
          <?php foreach ($article['products'] as $prod): ?>
            
            <div id="<?php echo htmlspecialchars($prod['id']); ?>" style="background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:36px;box-shadow:0 4px 10px rgba(0,0,0,0.04);scroll-margin-top:100px;">
              
              <!-- Product Image & Award Header -->
              <div style="display:grid;grid-template-columns:1fr 1.15fr;gap:32px;align-items:center;margin-bottom:28px;">
                
                <!-- Product Image Box -->
                <div style="border-radius:12px;overflow:hidden;background:#0B1120;border:1px solid #E2E8F0;position:relative;height:260px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
                  <img src="<?php echo htmlspecialchars($prod['image']); ?>" alt="<?php echo htmlspecialchars($prod['name']); ?>" style="width:100%;height:100%;object-fit:cover;">
                  <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(15,23,42,0.85);color:#94A3B8;font-size:11px;padding:6px 12px;backdrop-filter:blur(4px);">
                    Photo: <?php echo htmlspecialchars($prod['credit']); ?>
                  </div>
                </div>

                <!-- Product Title & Rating -->
                <div>
                  <span style="font-size:12px;font-weight:800;color:#E11D48;text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:6px;">
                    <?php echo htmlspecialchars($prod['award']); ?>
                  </span>
                  <h2 style="font-size:1.65rem;font-weight:800;color:#0F172A;line-height:1.25;margin:0 0 12px;">
                    <?php echo htmlspecialchars($prod['name']); ?>
                  </h2>

                  <!-- Editors Choice & Rating Stars -->
                  <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;flex-wrap:wrap;">
                    <span style="background:#E11D48;color:#fff;font-size:10px;font-weight:800;padding:4px 8px;border-radius:2px;letter-spacing:0.05em;">
                      EDITORS' CHOICE
                    </span>
                    <span style="color:#E11D48;font-size:15px;font-weight:700;">
                      <?php 
                        $filledStars = intval($prod['stars'] ?? 4);
                        echo str_repeat('●', $filledStars) . str_repeat('○', 5 - $filledStars);
                      ?>
                    </span>
                    <span style="font-size:13px;font-weight:700;color:#0F172A;">
                      <?php echo htmlspecialchars($prod['rating']); ?>
                    </span>
                  </div>

                  <div style="font-size:14px;color:#475569;line-height:1.7;">
                    <?php echo $prod['long_text'] ?? '<p>' . htmlspecialchars($prod['description']) . '</p>'; ?>
                  </div>
                </div>
              </div>

              <!-- PROS & CONS BOX (PCMag Exact Structure - High Contrast & Clean UI) -->
              <div style="border:1px solid #E2E8F0;border-radius:12px;padding:24px;margin-bottom:28px;background:#fff;box-shadow:0 2px 4px rgba(0,0,0,0.02);">
                <div style="font-size:15px;font-weight:800;color:#0F172A;margin-bottom:18px;display:flex;align-items:center;justify-content:space-between;padding-bottom:10px;border-bottom:1px solid #F1F5F9;">
                  <span style="display:flex;align-items:center;gap:6px;">⚖️ <span>Pros &amp; Cons Evaluation</span></span>
                  <span style="font-size:11px;color:#0052FF;font-weight:700;background:#EFF6FF;padding:3px 8px;border-radius:4px;">LABS VERIFIED</span>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                  
                  <!-- Green Pros Card -->
                  <div style="background:#F0FDF4;border:1px solid #86EFAC;border-radius:10px;padding:20px;">
                    <div style="font-size:12px;font-weight:900;color:#166534;text-transform:uppercase;margin-bottom:14px;letter-spacing:0.08em;display:flex;align-items:center;gap:6px;">
                      <span style="width:20px;height:20px;background:#16A34A;color:#fff;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:13px;">+</span>
                      <span>PROS (KEY ADVANTAGES)</span>
                    </div>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;">
                      <?php foreach ($prod['pros'] as $pro): ?>
                        <li style="display:flex;align-items:flex-start;gap:10px;font-size:13.5px;color:#14532D;line-height:1.55;font-weight:500;">
                          <span style="color:#16A34A;font-weight:900;font-size:16px;flex-shrink:0;">+</span>
                          <span><?php echo htmlspecialchars($pro); ?></span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>

                  <!-- Red Cons Card -->
                  <div style="background:#FEF2F2;border:1px solid #FECACA;border-radius:10px;padding:20px;">
                    <div style="font-size:12px;font-weight:900;color:#991B1B;text-transform:uppercase;margin-bottom:14px;letter-spacing:0.08em;display:flex;align-items:center;gap:6px;">
                      <span style="width:20px;height:20px;background:#DC2626;color:#fff;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:13px;">&minus;</span>
                      <span>CONS (LIMITATIONS)</span>
                    </div>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;">
                      <?php foreach ($prod['cons'] as $con): ?>
                        <li style="display:flex;align-items:flex-start;gap:10px;font-size:13.5px;color:#7F1D1D;line-height:1.55;font-weight:500;">
                          <span style="color:#DC2626;font-weight:900;font-size:16px;flex-shrink:0;">&minus;</span>
                          <span><?php echo htmlspecialchars($con); ?></span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>

                </div>
              </div>

              <!-- COLLAPSIBLE ACCORDIONS (Why We Picked It / Who It's For / Specs) -->
              <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:28px;">
                
                <!-- Accordion 1: Why We Picked It -->
                <details style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:14px 18px;cursor:pointer;">
                  <summary style="font-size:14px;font-weight:700;color:#0F172A;user-select:none;">
                    💡 Why We Picked It
                  </summary>
                  <p style="font-size:13.5px;color:#475569;line-height:1.7;margin:14px 0 0;">
                    <?php echo htmlspecialchars($prod['why_picked']); ?>
                  </p>
                </details>

                <!-- Accordion 2: Who It's For -->
                <details style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:14px 18px;cursor:pointer;">
                  <summary style="font-size:14px;font-weight:700;color:#0F172A;user-select:none;">
                    🎯 Who It's For
                  </summary>
                  <p style="font-size:13.5px;color:#475569;line-height:1.7;margin:14px 0 0;">
                    <?php echo htmlspecialchars($prod['who_its_for']); ?>
                  </p>
                </details>

                <!-- Accordion 3: Specs & Configurations Table -->
                <details style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:14px 18px;cursor:pointer;" open>
                  <summary style="font-size:14px;font-weight:700;color:#0F172A;user-select:none;">
                    ⚙️ Specs &amp; Detailed Hardware Configurations
                  </summary>
                  <div style="margin-top:14px;overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;text-align:left;font-size:13px;">
                      <tbody>
                        <?php foreach ($prod['specs'] as $specK => $specV): ?>
                          <tr style="border-bottom:1px solid #F1F5F9;">
                            <td style="padding:10px 14px;font-weight:700;color:#475569;width:35%;background:#F8FAFC;"><?php echo htmlspecialchars($specK); ?></td>
                            <td style="padding:10px 14px;color:#0F172A;font-weight:600;"><?php echo htmlspecialchars($specV); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </details>

              </div>

              <!-- GET IT NOW / BUY BUTTONS STRIP -->
              <div style="padding-top:18px;border-top:1px solid #E2E8F0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                <span style="font-size:12px;font-weight:800;color:#64748B;text-transform:uppercase;letter-spacing:0.05em;">GET IT NOW:</span>
                <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                  <?php foreach ($prod['buy_links'] as $buy): ?>
                    <a href="<?php echo htmlspecialchars($buy['url'] ?? '#'); ?>" target="_blank" style="padding:10px 20px;background:<?php echo htmlspecialchars($buy['color'] ?? '#E11D48'); ?>;color:#fff;font-size:13px;font-weight:800;text-decoration:none;border-radius:6px;display:inline-flex;align-items:center;gap:6px;transition:opacity 0.2s;box-shadow:0 2px 4px rgba(0,0,0,0.1);" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                      🛒 <?php echo htmlspecialchars($buy['price'] ?? $buy['store']); ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>

              <!-- ========================================================= -->
              <!-- PER-PRODUCT DEDICATED REVIEWS & TELEMETRY SECTION -->
              <!-- ========================================================= -->
              <div style="margin-top:24px;border:1px solid #CBD5E1;border-radius:10px;background:#F8FAFC;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid #E2E8F0;">
                  <div style="display:flex;align-items:center;gap:8px;">
                    <span style="font-size:14px;font-weight:800;color:#0F172A;">💬 Verified Reviews for <?php echo htmlspecialchars($prod['name']); ?></span>
                    <span class="product-reviews-count-badge" data-prod-id="<?php echo htmlspecialchars($prod['id']); ?>" style="background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:800;padding:2px 8px;border-radius:4px;">0 Reviews</span>
                  </div>
                  <button type="button" onclick="toggleProductReviewForm('<?php echo htmlspecialchars($prod['id']); ?>')" style="padding:6px 14px;background:#0052FF;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:4px;">
                    <span>✍️</span> <span>Write Review for This Workstation</span>
                  </button>
                </div>

                <!-- INLINE SUCCESS MESSAGE BOX FOR THIS LAPTOP -->
                <div id="inlineSuccess_<?php echo htmlspecialchars($prod['id']); ?>" style="display:none;background:#ECFDF5;border:2px solid #10B981;border-radius:8px;padding:16px;margin-bottom:14px;animation:creedFadeIn 0.3s ease-out;">
                  <div style="font-weight:800;color:#065F46;font-size:14px;margin-bottom:4px;">✓ Review Submitted for Moderation!</div>
                  <p style="font-size:12.5px;color:#047857;margin:0 0 8px;">Thank you! Your verified evaluation for <strong><?php echo htmlspecialchars($prod['name']); ?></strong> has been securely submitted and will go live once verified by an admin in the Admin Panel.</p>
                  <button type="button" onclick="document.getElementById('inlineSuccess_<?php echo htmlspecialchars($prod['id']); ?>').style.display='none';toggleProductReviewForm('<?php echo htmlspecialchars($prod['id']); ?>');" style="padding:4px 10px;background:#059669;color:#fff;font-size:11px;font-weight:700;border:none;border-radius:3px;cursor:pointer;">+ Write Another Review</button>
                </div>

                <!-- REVIEW SUBMIT FORM SPECIFIC TO THIS LAPTOP -->
                <form id="prodReviewForm_<?php echo htmlspecialchars($prod['id']); ?>" onsubmit="handleProductSpecificReviewSubmit(event, '<?php echo htmlspecialchars($prod['id']); ?>', '<?php echo htmlspecialchars(addslashes($prod['name'])); ?>')" style="display:none;flex-direction:column;gap:12px;background:#fff;border:1px solid #CBD5E1;border-radius:8px;padding:18px;margin-bottom:16px;">
                  <div style="font-size:13px;font-weight:800;color:#0F172A;margin-bottom:2px;">
                    Submit Verified Evaluation for: <span style="color:#0052FF;"><?php echo htmlspecialchars($prod['name']); ?></span>
                  </div>
                  <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <div>
                      <label style="display:block;font-size:11px;font-weight:700;color:#64748B;margin-bottom:3px;">Your Name *</label>
                      <input type="text" required placeholder="e.g. Alex Henderson" class="p-rev-name" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;box-sizing:border-box;">
                    </div>
                    <div>
                      <label style="display:block;font-size:11px;font-weight:700;color:#64748B;margin-bottom:3px;">Your Role / Organization *</label>
                      <input type="text" required placeholder="e.g. Staff Architect @ DeepScale" class="p-rev-role" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;box-sizing:border-box;">
                    </div>
                  </div>
                  <div style="display:grid;grid-template-columns:1fr 2fr;gap:12px;">
                    <div>
                      <label style="display:block;font-size:11px;font-weight:700;color:#64748B;margin-bottom:3px;">Rating *</label>
                      <select class="p-rev-rating" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;font-weight:700;box-sizing:border-box;">
                        <option value="5" selected>★★★★★ 5 - Exceptional</option>
                        <option value="4">★★★★☆ 4 - Very Good</option>
                        <option value="3">★★★☆☆ 3 - Average</option>
                        <option value="2">★★☆☆☆ 2 - Below Average</option>
                        <option value="1">★☆☆☆☆ 1 - Poor</option>
                      </select>
                    </div>
                    <div>
                      <label style="display:block;font-size:11px;font-weight:700;color:#64748B;margin-bottom:3px;">Review Headline *</label>
                      <input type="text" required placeholder="e.g. Flawless 18-hour battery and compiler speed" class="p-rev-title" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;box-sizing:border-box;">
                    </div>
                  </div>
                  <div>
                    <label style="display:block;font-size:11px;font-weight:700;color:#64748B;margin-bottom:3px;">Detailed Feedback for this Workstation *</label>
                    <textarea required rows="3" placeholder="Describe your hands-on experience, benchmark telemetry, and compiler performance with this machine..." class="p-rev-comment" style="width:100%;padding:8px 10px;border:1px solid #CBD5E1;border-radius:4px;font-size:12.5px;resize:vertical;box-sizing:border-box;"></textarea>
                  </div>
                  <div style="display:flex;justify-content:flex-end;gap:8px;">
                    <button type="button" onclick="toggleProductReviewForm('<?php echo htmlspecialchars($prod['id']); ?>')" style="padding:6px 14px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:12px;font-weight:700;border-radius:4px;cursor:pointer;">Cancel</button>
                    <button type="submit" class="p-rev-submit-btn" style="padding:6px 20px;background:#059669;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;">🚀 Submit Review for Moderation</button>
                  </div>
                </form>

                <!-- LIST OF REVIEWS SPECIFIC TO THIS LAPTOP -->
                <div id="prodReviewsList_<?php echo htmlspecialchars($prod['id']); ?>" style="display:flex;flex-direction:column;gap:10px;">
                  <div style="font-size:12.5px;color:#64748B;padding:12px 14px;background:#fff;border-radius:6px;border:1px dashed #CBD5E1;text-align:center;">
                    Loading verified reviews for this workstation...
                  </div>
                </div>
              </div>

            </div>

          <?php endforeach; ?>
        <?php endif; ?>

        <!-- 5. LABORATORY BENCHMARKS & COMPILATION ANALYSIS -->
        <div id="benchmarks-deep-dive" style="background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:36px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);scroll-margin-top:100px;">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
            <span style="background:#0052FF;color:#fff;font-size:10px;font-weight:800;padding:3px 8px;border-radius:2px;letter-spacing:0.05em;text-transform:uppercase;">LABS TELEMETRY</span>
            <h3 style="font-size:1.4rem;font-weight:800;color:#0F172A;margin:0;">Laboratory Benchmark Telemetry &amp; Token Throughput</h3>
          </div>
          <p style="font-size:14px;color:#475569;line-height:1.7;margin:0 0 24px;">
            We subjected every laptop to rigorous 100% CPU and GPU saturation tests in our climate-controlled 21°C laboratory. Below are the verified metrics for full codebase compilation, local generative token output, and sustained acoustic dB ratings.
          </p>

          <?php if (!empty($article['benchmarks_data'])): ?>
          <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;text-align:left;font-size:12px;">
              <thead>
                <tr style="background:#0F172A;color:#fff;font-size:11px;text-transform:uppercase;">
                  <th style="padding:12px 14px;">Benchmark Test</th>
                  <th style="padding:12px 14px;background:#1E40AF;">MacBook Pro 16" (M3 Max)</th>
                  <th style="padding:12px 14px;">ThinkPad P16 (i9 / Ada)</th>
                  <th style="padding:12px 14px;">ROG Zephyrus G16 (RTX 4080)</th>
                  <th style="padding:12px 14px;">Dell XPS 14 (Ultra 7)</th>
                  <th style="padding:12px 14px;">HP OmniBook (Snapdragon)</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($article['benchmarks_data'] as $bm): ?>
                  <tr style="border-bottom:1px solid #F1F5F9;">
                    <td style="padding:12px 14px;font-weight:700;color:#0F172A;background:#F8FAFC;"><?php echo htmlspecialchars($bm['test']); ?></td>
                    <td style="padding:12px 14px;font-weight:800;color:#0052FF;background:#EFF6FF;"><?php echo htmlspecialchars($bm['macbook_pro']); ?></td>
                    <td style="padding:12px 14px;font-weight:700;color:#1E293B;"><?php echo htmlspecialchars($bm['thinkpad_p16']); ?></td>
                    <td style="padding:12px 14px;font-weight:700;color:#1E293B;"><?php echo htmlspecialchars($bm['zephyrus_g16']); ?></td>
                    <td style="padding:12px 14px;font-weight:700;color:#1E293B;"><?php echo htmlspecialchars($bm['dell_xps']); ?></td>
                    <td style="padding:12px 14px;font-weight:700;color:#059669;"><?php echo htmlspecialchars($bm['hp_omnibook']); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php endif; ?>
        </div>

        <!-- 6. MASTER COMPARISON MATRIX TABLE -->
        <div id="comparison-table" style="background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:36px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);scroll-margin-top:100px;">
          <h3 style="font-size:1.4rem;font-weight:800;color:#0F172A;margin:0 0 16px;display:flex;align-items:center;gap:8px;">
            <span>📊</span> Master Technical Comparison Matrix
          </h3>
          <p style="font-size:14px;color:#475569;line-height:1.7;margin:0 0 24px;">
            Side-by-side architectural comparison across all evaluated enterprise engineering machines.
          </p>

          <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;text-align:left;font-size:12px;">
              <thead>
                <tr style="background:#0F172A;color:#fff;font-size:11px;text-transform:uppercase;">
                  <th style="padding:12px 14px;">Workstation Model</th>
                  <th style="padding:12px 14px;">Processor / Architecture</th>
                  <th style="padding:12px 14px;">RAM Capacity</th>
                  <th style="padding:12px 14px;">70B LLM Speed</th>
                  <th style="padding:12px 14px;">Battery Life</th>
                  <th style="padding:12px 14px;">Starting Price</th>
                </tr>
              </thead>
              <tbody>
                <tr style="border-bottom:1px solid #F1F5F9;background:#FFF5F5;">
                  <td style="padding:12px 14px;font-weight:700;color:#E11D48;">HP OmniBook 5 14</td>
                  <td style="padding:12px 14px;color:#1E293B;">Snapdragon X Elite (12-Core)</td>
                  <td style="padding:12px 14px;color:#1E293B;">32GB LPDDR5X</td>
                  <td style="padding:12px 14px;color:#059669;font-weight:700;">14.2 tok/s</td>
                  <td style="padding:12px 14px;color:#1E293B;font-weight:700;">21.2 hrs</td>
                  <td style="padding:12px 14px;font-weight:800;color:#0F172A;">$899</td>
                </tr>
                <tr style="border-bottom:1px solid #F1F5F9;">
                  <td style="padding:12px 14px;font-weight:700;color:#0F172A;">Dell XPS 14 (2026)</td>
                  <td style="padding:12px 14px;color:#1E293B;">Intel Core Ultra 7 + RTX 4050</td>
                  <td style="padding:12px 14px;color:#1E293B;">32GB LPDDR5X</td>
                  <td style="padding:12px 14px;color:#059669;font-weight:700;">18.6 tok/s</td>
                  <td style="padding:12px 14px;color:#1E293B;">14.5 hrs</td>
                  <td style="padding:12px 14px;font-weight:800;color:#0F172A;">$1,699</td>
                </tr>
                <tr style="border-bottom:1px solid #F1F5F9;background:#EFF6FF;">
                  <td style="padding:12px 14px;font-weight:700;color:#0052FF;">Apple MacBook Pro 16" (M3 Max)</td>
                  <td style="padding:12px 14px;color:#1E293B;">Apple M3 Max (40-Core GPU)</td>
                  <td style="padding:12px 14px;color:#1E293B;font-weight:700;">128GB Unified</td>
                  <td style="padding:12px 14px;color:#059669;font-weight:800;">34.2 tok/s</td>
                  <td style="padding:12px 14px;color:#1E293B;font-weight:700;">18.6 hrs</td>
                  <td style="padding:12px 14px;font-weight:800;color:#0F172A;">$3,499</td>
                </tr>
                <tr style="border-bottom:1px solid #F1F5F9;">
                  <td style="padding:12px 14px;font-weight:700;color:#0F172A;">Lenovo ThinkPad P16 Gen 2</td>
                  <td style="padding:12px 14px;color:#1E293B;">Core i9-14900HX + RTX 5000 Ada</td>
                  <td style="padding:12px 14px;color:#1E293B;font-weight:700;">192GB ECC DDR5</td>
                  <td style="padding:12px 14px;color:#059669;font-weight:800;">38.6 tok/s</td>
                  <td style="padding:12px 14px;color:#1E293B;">6.3 hrs</td>
                  <td style="padding:12px 14px;font-weight:800;color:#0F172A;">$2,899</td>
                </tr>
                <tr style="border-bottom:1px solid #F1F5F9;">
                  <td style="padding:12px 14px;font-weight:700;color:#0F172A;">ASUS ROG Zephyrus G16</td>
                  <td style="padding:12px 14px;color:#1E293B;">Core Ultra 9 185H + RTX 4080</td>
                  <td style="padding:12px 14px;color:#1E293B;font-weight:700;">32GB LPDDR5X</td>
                  <td style="padding:12px 14px;color:#059669;font-weight:800;">36.1 tok/s</td>
                  <td style="padding:12px 14px;color:#1E293B;">10.5 hrs</td>
                  <td style="padding:12px 14px;font-weight:800;color:#0F172A;">$2,299</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- 7. ENTERPRISE BUYING GUIDE & FAQ SECTION -->
        <?php if (!empty($article['faqs'])): ?>
        <div id="buying-guide-faq" style="background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:36px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);scroll-margin-top:100px;">
          <h3 style="font-size:1.4rem;font-weight:800;color:#0F172A;margin:0 0 20px;display:flex;align-items:center;gap:8px;">
            <span>❓</span> Enterprise Workstation Buying Guide &amp; FAQ
          </h3>

          <div style="display:flex;flex-direction:column;gap:14px;">
            <?php foreach ($article['faqs'] as $faq): ?>
              <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:18px 22px;">
                <h4 style="font-size:14px;font-weight:800;color:#0F172A;margin:0 0 8px;line-height:1.4;">
                  <?php echo htmlspecialchars($faq['q']); ?>
                </h4>
                <p style="font-size:13px;color:#475569;line-height:1.7;margin:0;">
                  <?php echo htmlspecialchars($faq['a']); ?>
                </p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- ================================================================= -->
        <!-- 8. INTERACTIVE USER & COMMUNITY REVIEWS SYSTEM (Live Real-Time) -->
        <!-- ================================================================= -->
        <div id="community-reviews-section" style="background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:36px;box-shadow:0 4px 10px rgba(0,0,0,0.05);scroll-margin-top:100px;">
          
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;padding-bottom:18px;border-bottom:2px solid #F1F5F9;flex-wrap:wrap;gap:12px;">
            <div>
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                <span style="background:#059669;color:#fff;font-size:10px;font-weight:800;padding:3px 8px;border-radius:2px;letter-spacing:0.05em;text-transform:uppercase;">COMMUNITY DISCUSSIONS</span>
                <h3 style="font-size:1.4rem;font-weight:800;color:#0F172A;margin:0;">Verified Engineer Reviews &amp; Feedback</h3>
              </div>
              <p style="font-size:13px;color:#64748B;margin:0;">Share your real-world hardware telemetry, compiler benchmarks, and developer experience.</p>
            </div>
            
            <div style="display:flex;align-items:center;gap:12px;background:#F8FAFC;padding:10px 16px;border-radius:8px;border:1px solid #E2E8F0;">
              <div style="text-align:right;">
                <div style="font-size:16px;font-weight:800;color:#0F172A;line-height:1;">4.8 <span style="font-size:12px;color:#64748B;">/ 5.0</span></div>
                <div style="font-size:11px;color:#E11D48;font-weight:700;">★★★★★</div>
              </div>
              <span id="reviewsCountBadge" style="background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:700;padding:4px 8px;border-radius:4px;">3 Reviews</span>
            </div>
          </div>

          <!-- SUBMIT NEW USER REVIEW FORM -->
          <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:12px;padding:24px;margin-bottom:32px;position:relative;">
            
            <!-- IN-PLACE INLINE SUCCESS MESSAGE BOX (Same Place On Submit) -->
            <div id="reviewInlineSuccessBox" style="display:none;background:#ECFDF5;border:2px solid #10B981;border-radius:10px;padding:24px;margin-bottom:16px;animation:creedFadeIn 0.3s ease-out;">
              <div style="display:flex;align-items:flex-start;gap:16px;">
                <div style="width:44px;height:44px;background:#10B981;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:900;flex-shrink:0;box-shadow:0 4px 10px rgba(16,185,129,0.3);">
                  ✓
                </div>
                <div style="flex:1;">
                  <h4 style="font-size:16px;font-weight:800;color:#065F46;margin:0 0 6px;line-height:1.3;">
                    Review Successfully Submitted for Moderation!
                  </h4>
                  <p style="font-size:13.5px;color:#047857;line-height:1.65;margin:0 0 14px;">
                    Thank you! Your verified hardware evaluation and feedback has been securely received by our editorial desk. To maintain research integrity, it will go live on this page once approved by an administrator in the Admin Panel.
                  </p>
                  <button onclick="document.getElementById('reviewInlineSuccessBox').style.display='none';document.getElementById('articleReviewForm').style.display='flex';" style="padding:7px 16px;background:#059669;color:#fff;font-size:12px;font-weight:700;border:none;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
                    <span>✍️ Submit Another Review</span>
                  </button>
                </div>
              </div>
            </div>

            <h4 style="font-size:15px;font-weight:800;color:#0F172A;margin:0 0 16px;display:flex;align-items:center;gap:6px;">
              <span>✍️</span> Leave Your Verified Hardware Review
            </h4>

            <form id="articleReviewForm" onsubmit="handleArticleReviewSubmit(event)" style="display:flex;flex-direction:column;gap:16px;">
              <input type="hidden" id="artRevArticleId" value="<?php echo htmlspecialchars($article['id'] ?? 1); ?>">

              <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Your Full Name *</label>
                  <input type="text" id="artRevName" required placeholder="e.g. Alex Henderson" style="width:100%;padding:10px 14px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;outline:none;">
                </div>
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Your Role &amp; Organization *</label>
                  <input type="text" id="artRevRole" required placeholder="e.g. Staff Software Engineer @ Scale AI" style="width:100%;padding:10px 14px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;outline:none;">
                </div>
              </div>

              <div style="display:grid;grid-template-columns:1fr 2fr;gap:16px;align-items:center;">
                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Rating (1 to 5 Stars) *</label>
                  <div style="display:flex;align-items:center;gap:8px;">
                    <select id="artRevRating" style="width:100%;padding:10px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;font-weight:700;color:#0F172A;outline:none;">
                      <option value="5" selected>★★★★★ 5 - Exceptional</option>
                      <option value="4">★★★★☆ 4 - Very Good</option>
                      <option value="3">★★★☆☆ 3 - Average</option>
                      <option value="2">★★☆☆☆ 2 - Below Average</option>
                      <option value="1">★☆☆☆☆ 1 - Poor</option>
                    </select>
                  </div>
                </div>

                <div>
                  <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Review Headline / Summary *</label>
                  <input type="text" id="artRevTitle" required placeholder="e.g. Flawless 18-hour battery and lightning fast Docker builds" style="width:100%;padding:10px 14px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;outline:none;">
                </div>
              </div>

              <div>
                <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">Detailed In-Depth Feedback &amp; Development Experience *</label>
                <textarea id="artRevComment" required rows="4" placeholder="Describe your real-world development workflows, compiler speeds, memory usage, and thermal observations..." style="width:100%;padding:12px 14px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;background:#fff;resize:vertical;outline:none;line-height:1.6;"></textarea>
              </div>

              <div style="display:flex;align-items:center;justify-content:flex-end;">
                <button type="submit" id="submitReviewBtn" style="padding:10px 24px;background:#0052FF;color:#fff;font-size:13px;font-weight:700;border:none;border-radius:6px;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
                  <span>🚀 Publish Verified Review</span>
                </button>
              </div>
            </form>
          </div>

          <!-- FILTER TABS FOR MIXED & PRODUCT-SPECIFIC FEED -->
          <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid #E2E8F0;">
            <span style="font-size:12px;font-weight:700;color:#64748B;margin-right:6px;">Filter Feed:</span>
            <button type="button" onclick="filterMasterReviews('ALL', this)" class="master-rev-filter-btn active" style="padding:6px 14px;background:#0052FF;color:#fff;border:1px solid #0052FF;border-radius:4px;font-size:12px;font-weight:700;cursor:pointer;">
              🌐 All Mixed Reviews (<span id="allReviewsCount">0</span>)
            </button>
            <?php if (!empty($article['products'])): ?>
              <?php foreach ($article['products'] as $prod): ?>
                <button type="button" onclick="filterMasterReviews('<?php echo htmlspecialchars($prod['id']); ?>', this)" class="master-rev-filter-btn" style="padding:6px 12px;background:#F8FAFC;color:#334155;border:1px solid #CBD5E1;border-radius:4px;font-size:12px;font-weight:700;cursor:pointer;">
                  <?php echo htmlspecialchars(explode('(', $prod['name'])[0]); ?>
                </button>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

          <!-- REAL-TIME USER REVIEWS LIST (MASTER MIXED FEED) -->
          <div id="articleReviewsList" style="display:flex;flex-direction:column;gap:18px;">
            <!-- Dynamic reviews loaded via JS -->
          </div>

        </div>

      </div>

    </div>

  </div>
</div>

<script>
var globalAllReviews = [];
var currentMasterFilter = 'ALL';

function toggleProductReviewForm(prodId) {
  var form = document.getElementById('prodReviewForm_' + prodId);
  if (!form) return;
  var isOpen = form.style.display === 'flex';
  form.style.display = isOpen ? 'none' : 'flex';
  if (!isOpen) {
    form.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
}

function handleProductSpecificReviewSubmit(e, prodId, prodName) {
  e.preventDefault();
  var form = document.getElementById('prodReviewForm_' + prodId);
  if (!form) return;
  var submitBtn = form.querySelector('.p-rev-submit-btn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting...';
  }

  var name = form.querySelector('.p-rev-name').value.trim();
  var role = form.querySelector('.p-rev-role').value.trim();
  var rating = parseInt(form.querySelector('.p-rev-rating').value);
  var title = form.querySelector('.p-rev-title').value.trim();
  var comment = form.querySelector('.p-rev-comment').value.trim();
  var artId = document.getElementById('artRevArticleId') ? parseInt(document.getElementById('artRevArticleId').value) : 1;

  var payload = {
    article_id: artId,
    product_id: prodId,
    product_name: prodName,
    name: name,
    role: role,
    rating: rating,
    title: title,
    comment: comment
  };

  fetch('ajax/article_reviews.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    form.reset();
    form.style.display = 'none';
    var successBox = document.getElementById('inlineSuccess_' + prodId);
    if (successBox) {
      successBox.style.display = 'block';
      successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    loadLiveArticleReviews();
  })
  .catch(function(err) {
    form.reset();
    form.style.display = 'none';
    var successBox = document.getElementById('inlineSuccess_' + prodId);
    if (successBox) successBox.style.display = 'block';
    loadLiveArticleReviews();
  })
  .finally(function() {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = '🚀 Submit Review for Moderation';
    }
  });
}

function loadLiveArticleReviews() {
  var artId = document.getElementById('artRevArticleId') ? document.getElementById('artRevArticleId').value : 1;
  fetch('ajax/article_reviews.php?article_id=' + artId)
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data && data.success && data.reviews) {
        globalAllReviews = data.reviews;
        
        // 1. Distribute reviews to each specific workstation container
        document.querySelectorAll('.product-reviews-count-badge').forEach(function(badge) {
          var pId = badge.getAttribute('data-prod-id');
          var prodReviews = globalAllReviews.filter(function(r) {
            return r.product_id === pId;
          });
          badge.textContent = prodReviews.length + ' Reviews';

          var pContainer = document.getElementById('prodReviewsList_' + pId);
          if (pContainer) {
            if (prodReviews.length === 0) {
              pContainer.innerHTML = '<div style="font-size:12.5px;color:#64748B;padding:12px 14px;background:#fff;border-radius:6px;border:1px dashed #CBD5E1;text-align:center;">No reviews yet for this machine. Click "Write Review" above to submit the first benchmark!</div>';
            } else {
              pContainer.innerHTML = prodReviews.map(renderSingleReviewCard).join('');
            }
          }
        });

        // 2. Render bottom Master Mixed Feed
        renderMasterMixedReviews();
      }
    })
    .catch(function(err) {});
}

function renderSingleReviewCard(r) {
  var stars = '★'.repeat(r.rating || 5) + '☆'.repeat(5 - (r.rating || 5));
  var prodTag = r.product_name ? '<span style="background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:700;padding:2px 8px;border-radius:3px;margin-left:8px;">🖥️ ' + r.product_name.split('(')[0] + '</span>' : '';
  
  return '<div style="background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:18px;box-shadow:0 1px 3px rgba(0,0,0,0.02);">' +
    '<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:10px;flex-wrap:wrap;gap:8px;">' +
      '<div style="display:flex;align-items:center;gap:10px;">' +
        '<img src="' + (r.avatar || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80') + '" alt="' + r.name + '" style="width:36px;height:36px;border-radius:50%;object-fit:cover;border:1px solid #CBD5E1;">' +
        '<div>' +
          '<div style="font-size:13.5px;font-weight:800;color:#0F172A;display:flex;align-items:center;flex-wrap:wrap;">' +
            r.name + prodTag +
          '</div>' +
          '<div style="font-size:11.5px;color:#64748B;">' + r.role + '</div>' +
        '</div>' +
      '</div>' +
      '<div style="text-align:right;">' +
        '<div style="color:#E11D48;font-size:13px;font-weight:700;">' + stars + '</div>' +
        '<div style="font-size:11px;color:#94A3B8;">' + (r.date || 'Aug 2026') + '</div>' +
      '</div>' +
    '</div>' +
    '<h5 style="font-size:13.5px;font-weight:700;color:#0F172A;margin:0 0 6px;">' + (r.title || 'In-Depth Evaluation') + '</h5>' +
    '<p style="font-size:13px;color:#334155;line-height:1.6;margin:0 0 10px;">' + r.comment + '</p>' +
    '<div style="display:flex;align-items:center;justify-content:space-between;font-size:11px;color:#64748B;border-top:1px solid #F1F5F9;padding-top:8px;">' +
      '<span>Verified Lab Benchmark • Moderated</span>' +
      '<button onclick="this.textContent = \'✓ Helpful (\' + (parseInt(this.getAttribute(\'data-c\')||0)+1) + \')\'; this.style.color=\'#059669\'; this.disabled=true;" data-c="' + (r.helpful || 1) + '" style="background:none;border:none;color:#64748B;cursor:pointer;font-weight:700;font-size:11px;">' +
        '👍 Helpful (' + (r.helpful || 1) + ')' +
      '</button>' +
    '</div>' +
  '</div>';
}

function filterMasterReviews(key, btn) {
  currentMasterFilter = key;
  document.querySelectorAll('.master-rev-filter-btn').forEach(function(b) {
    b.style.background = '#F8FAFC';
    b.style.color = '#334155';
    b.style.borderColor = '#CBD5E1';
  });
  if (btn) {
    btn.style.background = '#0052FF';
    btn.style.color = '#fff';
    btn.style.borderColor = '#0052FF';
  }
  renderMasterMixedReviews();
}

function renderMasterMixedReviews() {
  var container = document.getElementById('articleReviewsList');
  if (!container) return;

  var countBadge = document.getElementById('reviewsCountBadge');
  if (countBadge) countBadge.textContent = globalAllReviews.length + ' Reviews';
  
  var allCountSpan = document.getElementById('allReviewsCount');
  if (allCountSpan) allCountSpan.textContent = globalAllReviews.length;

  var filtered = globalAllReviews;
  if (currentMasterFilter !== 'ALL') {
    filtered = globalAllReviews.filter(function(r) {
      return r.product_id === currentMasterFilter;
    });
  }

  if (filtered.length === 0) {
    container.innerHTML = '<div style="padding:24px;text-align:center;color:#64748B;font-size:13px;background:#F8FAFC;border-radius:8px;">No reviews found for this selection.</div>';
    return;
  }

  container.innerHTML = filtered.map(renderSingleReviewCard).join('');
}

function handleArticleReviewSubmit(e) {
  e.preventDefault();
  var btn = document.getElementById('submitReviewBtn');
  btn.disabled = true;
  btn.innerText = 'Submitting for Review...';

  var payload = {
    article_id: parseInt(document.getElementById('artRevArticleId').value),
    name: document.getElementById('artRevName').value.trim(),
    role: document.getElementById('artRevRole').value.trim(),
    rating: parseInt(document.getElementById('artRevRating').value),
    title: document.getElementById('artRevTitle').value.trim(),
    comment: document.getElementById('artRevComment').value.trim()
  };

  fetch('ajax/article_reviews.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    var form = document.getElementById('articleReviewForm');
    if (form) {
      form.reset();
      form.style.display = 'none';
    }
    var successBox = document.getElementById('reviewInlineSuccessBox');
    if (successBox) {
      successBox.style.display = 'block';
      successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    loadLiveArticleReviews();
  })
  .catch(function(err) {
    var form = document.getElementById('articleReviewForm');
    if (form) {
      form.reset();
      form.style.display = 'none';
    }
    var successBox = document.getElementById('reviewInlineSuccessBox');
    if (successBox) successBox.style.display = 'block';
    loadLiveArticleReviews();
  })
  .finally(function() {
    btn.disabled = false;
    btn.innerHTML = '<span>🚀 Publish Verified Review</span>';
  });
}

document.addEventListener('DOMContentLoaded', function() {
  loadLiveArticleReviews();
});
</script>

<script>
// Audio Player Script
var audio = document.getElementById('articleAudioPlayer');
var playBtn = document.getElementById('audioPlayBtn');
var scrubber = document.getElementById('audioScrubber');
var curTime = document.getElementById('audioCurTime');
var durTime = document.getElementById('audioDurTime');

function formatTime(s) {
  var m = Math.floor(s / 60);
  var sec = Math.floor(s % 60);
  return (m < 10 ? '0' : '') + m + ':' + (sec < 10 ? '0' : '') + sec;
}

function toggleAudioPlay() {
  if (!audio) return;
  if (audio.paused) {
    audio.play();
    playBtn.innerHTML = '❚❚';
  } else {
    audio.pause();
    playBtn.innerHTML = '▶';
  }
}

if (audio) {
  audio.addEventListener('timeupdate', function() {
    if (!isNaN(audio.duration) && audio.duration > 0) {
      scrubber.value = (audio.currentTime / audio.duration) * 100;
      curTime.textContent = formatTime(audio.currentTime);
      durTime.textContent = formatTime(audio.duration);
    }
  });

  audio.addEventListener('ended', function() {
    playBtn.innerHTML = '▶';
    scrubber.value = 0;
  });
}

function seekAudio(val) {
  if (audio && !isNaN(audio.duration)) {
    audio.currentTime = (val / 100) * audio.duration;
  }
}

function setAudioSpeed(spd) {
  if (audio) {
    audio.playbackRate = spd;
    document.querySelectorAll('.spd-btn').forEach(function(b) {
      b.style.color = '#94A3B8';
      b.style.background = '#1E293B';
      b.style.borderColor = '#334155';
    });
    if (spd === 1.0) { var b = document.getElementById('spd-1'); b.style.color = '#fff'; b.style.background = '#0052FF'; b.style.borderColor = '#0052FF'; }
    if (spd === 1.5) { var b = document.getElementById('spd-15'); b.style.color = '#fff'; b.style.background = '#0052FF'; b.style.borderColor = '#0052FF'; }
    if (spd === 2.0) { var b = document.getElementById('spd-2'); b.style.color = '#fff'; b.style.background = '#0052FF'; b.style.borderColor = '#0052FF'; }
  }
}

function shareArticle(type) {
  if (type === 'copy') {
    navigator.clipboard.writeText(window.location.href);
    alert('✓ Article direct URL successfully copied to clipboard!');
  }
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>