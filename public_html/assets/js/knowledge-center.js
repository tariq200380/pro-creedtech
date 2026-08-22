// Articles Store for In-Place Dynamic Reading
var ARTICLES_STORE = [
  {
    id: 1,
    category: "HARDWARE & AI WORKSTATIONS",
    date: "Aug 16, 2026",
    read_time: "18 min read",
    views: "64,250",
    title: "The 7 Best Enterprise AI & Cloud Laptops for Senior Engineers & Architects",
    author: "Dr. Sarah Jenkins (Chief Systems Architect) & Marcus Vance (Senior Hardware Lead)",
    editors_note: "August 2026: With this comprehensive update, our hardware engineering squad has vetted dozens of flagship workstations specifically for local generative AI inference, multi-container Docker and Kubernetes orchestrations, and massive distributed compiler builds. We run continuous 24-hour thermal dissipation tests in Creed Tech Labs to ensure these machines maintain peak turbo frequencies without thermal throttling.",
    intro_paragraphs: [
      "Choosing an engineering workstation in 2026 is fundamentally different from selecting a standard consumer laptop. With enterprise software teams increasingly executing local neural fine-tuning, running quantized 70-billion-parameter foundation models completely offline, and managing complex multi-tier containerized microservices stacks, traditional ultrabooks with 16GB of soldered RAM simply crumble under memory pressure.",
      "In our labs over the past six months, we evaluated more than 25 workstations across seven critical hardware vectors: sustained memory bandwidth, zero-copy unified RAM pooling, sustained multi-core compilation times under heavy thermal loads, thermal acoustic dB output, display color accuracy for design fidelity, keyboard actuation ergonomics, and real-world unplugged battery longevity.",
      "Below, you will find our deep-dive architectural analysis, comprehensive laboratory benchmark comparisons, pros and cons breakdowns, and detailed product-by-product evaluations."
    ],
    video_url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
    audio_url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
    products: [
      {
        id: "hp-omnibook",
        award: "Best Windows Laptop for Most People",
        name: "HP OmniBook 5 14 (Qualcomm Snapdragon X Elite / OLED)",
        rating: "4.0 Excellent",
        stars: 4,
        price: "$899",
        image: "https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?q=80&w=1000&auto=format&fit=crop",
        pros: [
          "Field-leading battery endurance (21 hours 14 minutes continuous execution)",
          "Aggressively priced starting at just $899 with 32GB LPDDR5X RAM",
          "Vivid 14.0-inch 2.8K (2880x1800) OLED 120Hz display with 100% DCI-P3 color gamut",
          "Whisper-quiet dual fans that remain below 24 dB under typical IDE workloads"
        ],
        cons: [
          "Plastic keyboard deck could benefit from additional internal structural stiffening",
          "Occasional x86 translation overhead on legacy, unoptimized Windows kernel-mode drivers"
        ],
        long_text: "<p>The HP OmniBook 5 14 marks a seismic transition in the Windows laptop ecosystem. Built around Qualcomm's 4nm Oryon CPU architecture, it eliminates the historical compromise between high-performance computing and true all-day battery life.</p>",
        specs: {
          "Processor (CPU)": "Qualcomm Snapdragon X Elite (12 Cores, up to 3.8 GHz Turbo)",
          "Neural Engine (NPU)": "Qualcomm Hexagon NPU (45 TOPS dedicated AI compute)",
          "Memory (RAM)": "32GB LPDDR5X-8448 MHz",
          "Storage (SSD)": "1TB PCIe Gen4 x4 NVMe M.2 2280 SSD"
        },
        buy_links: [
          { store: "Amazon", price: "$899 at Amazon", color: "#FF9900", url: "https://amazon.com" }
        ]
      },
      {
        id: "macbook-pro-16",
        award: "Best Workstation for AI Engineers",
        name: "Apple MacBook Pro 16\" (M3 Max / 128GB Unified Memory)",
        rating: "4.5 Exceptional",
        stars: 5,
        price: "$3,499",
        image: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=1000&auto=format&fit=crop",
        pros: [
          "Unrivaled 128GB Unified RAM running Llama-3-70B Q4_K_M completely in VRAM",
          "400 GB/s memory bandwidth obliterates standard GPU transfer bottlenecks",
          "Liquid Retina XDR Mini-LED display with 1600 nits peak HDR and 120Hz ProMotion"
        ],
        cons: [
          "Substantial financial investment starting above $3,400",
          "Unified RAM and SSD are fully integrated on-die and cannot be upgraded post-purchase"
        ],
        long_text: "<p>For AI researchers and distributed systems architects, the 16-inch MacBook Pro configured with the 16-core M3 Max and 128GB Unified Memory is nothing short of a computing revelation.</p>",
        specs: {
          "Processor (CPU)": "Apple M3 Max (16-Core: 12 Performance + 4 Efficiency)",
          "Graphics (GPU)": "40-Core GPU with Hardware Ray Tracing",
          "Unified Memory": "128GB Unified Memory (400 GB/s Bandwidth)",
          "Storage (SSD)": "4TB PCIe Gen4 SSD (7,400 MB/s Read)"
        },
        buy_links: [
          { store: "Apple Store", price: "$3,499 at Apple", color: "#000000", url: "https://apple.com" }
        ]
      }
    ]
  },
  {
    id: 2,
    category: "AI RESEARCH & HISTORY",
    date: "Aug 15, 2026",
    read_time: "12 min read",
    views: "42,100",
    title: "Artificial Intelligence Development from 1950 to 1965: The Foundation of Modern AI Research",
    author: "Dr. Marcus Vance (Principal AI Fellow)",
    editors_note: "A deep historical and algorithmic exploration into the early Dartmouth workshops, symbolic logic, Perceptron neural primitives, and early compiler architectures.",
    intro_paragraphs: [
      "The epoch spanning 1950 to 1965 defined the fundamental computational principles of modern artificial intelligence. From Alan Turing's seminal 1950 paper 'Computing Machinery and Intelligence' introducing the imitation game to the 1956 Dartmouth Summer Research Project where John McCarthy coined the term 'Artificial Intelligence', this era established symbolic computation, heuristic search, and neural perceptrons.",
      "Understanding these mathematical foundations is essential for contemporary enterprise architects working with modern deep learning and sovereign model fine-tuning."
    ],
    video_url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
    audio_url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
    products: [
      {
        id: "ai-perceptrons",
        award: "Historical Computing Benchmark",
        name: "Dartmouth Workshop & Rosenblatt Perceptron Mark I (1956-1960)",
        rating: "5.0 Landmark",
        stars: 5,
        price: "Historical Archive",
        image: "https://images.unsplash.com/photo-1677442136019-21780efad99a?q=80&w=1000&auto=format&fit=crop",
        pros: [
          "Established first single-layer artificial neural network weighting equations",
          "Formulated LISP programming language for symbolic knowledge representation"
        ],
        cons: [
          "Limited by 4KB magnetic-core hardware memory constraints"
        ],
        long_text: "<p>The Mark I Perceptron was the world's first hardware implementation of an artificial neural network.</p>",
        specs: {
          "Hardware Architecture": "IBM 704 Vacuum Tube Mainframe",
          "Memory Capacity": "4,096 36-bit words (Magnetic Core)",
          "Clock Speed": "40,000 instructions per second"
        },
        buy_links: []
      }
    ]
  },
  {
    id: 3,
    category: "CLOUD INFRASTRUCTURE",
    date: "Aug 14, 2026",
    read_time: "14 min read",
    views: "38,900",
    title: "Cloud Native Microservices Architecture: A Deep Dive into Kubernetes Orchestration",
    author: "Helena Rostova (VP of Cloud & SRE)",
    editors_note: "An executive blueprint on architecting self-healing, multi-tenant Kubernetes clusters with zero-trust eBPF service meshes, automatic pod horizontal scaling, and sub-10ms P99 latency guarantees.",
    intro_paragraphs: [
      "Modern enterprise systems require continuous 99.999% SLA availability. Moving beyond monolithic architectures to microservices requires robust service discovery, distributed tracing, and automated canary deployments.",
      "In this analysis, we evaluate the architectural tradeoffs between Envoy proxy service meshes, eBPF-based kernel routing with Cilium, and GitOps continuous delivery pipelines."
    ],
    video_url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
    audio_url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
    products: [
      {
        id: "k8s-blueprint",
        award: "Enterprise SRE Blueprint",
        name: "Creed Sovereign Multi-Region Kubernetes Topology (v1.31)",
        rating: "4.9 Enterprise Grade",
        stars: 5,
        price: "Open Architecture",
        image: "https://images.unsplash.com/photo-1667372393119-3d4c48d07fc9?q=80&w=1000&auto=format&fit=crop",
        pros: [
          "Sub-10ms P99 intra-cluster API latency across 5 global availability zones",
          "Automated Cilium eBPF packet routing bypassing iptables bottlenecks"
        ],
        cons: [
          "Requires advanced SRE expertise for custom eBPF kernel debugging"
        ],
        long_text: "<p>By leveraging eBPF in modern Linux kernels, network packets are routed directly at the network interface layer without incurring standard netfilter CPU overhead.</p>",
        specs: {
          "Service Mesh Layer": "Cilium eBPF (Kernel 6.8+)",
          "Ingress Gateway": "Envoy Gateway 1.30 with mTLS 1.3"
        },
        buy_links: []
      }
    ]
  }
];

if (window.CREED_KC_INIT && Array.isArray(window.CREED_KC_INIT.dynamicArticles) && window.CREED_KC_INIT.dynamicArticles.length > 0) {
  window.CREED_KC_INIT.dynamicArticles.forEach(function(dArt) {
    var existingIdx = ARTICLES_STORE.findIndex(function(a) { return a.id === dArt.id; });
    if (existingIdx >= 0) {
      ARTICLES_STORE[existingIdx] = Object.assign({}, ARTICLES_STORE[existingIdx], dArt);
    } else {
      ARTICLES_STORE.push(dArt);
    }
  });
}

// Fallback / Initial Post-Specific Reviews Data
var POST_REVIEWS_STORE = {
  1: [
    {
      name: "Dr. Marcus Vance",
      role: "Chief Technology Officer @ FinTech Global Frankfurt",
      avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 16, 2026",
      title: "M3 Max with 128GB RAM transformed our local LLM development",
      comment: "This in-depth benchmark matches our internal production findings exactly. Having 128GB of unified memory allows our engineering squads to run unquantized Llama-3-70B models directly on the laptop during transatlantic flights with zero cloud dependency. Outstanding review depth.",
      helpful: 34
    },
    {
      name: "David Thorne",
      role: "Principal Systems Engineer @ CloudNative US",
      avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 15, 2026",
      title: "21 hours real battery life while compiling Rust is unbelievable",
      comment: "Qualcomm Snapdragon X Elite has truly redefined what ARM on Windows can do. Zero fan noise during heavy code refactoring in VS Code and it easily lasted 2 full work days on a single charge.",
      helpful: 42
    },
    {
      name: "Elena Rostova",
      role: "Principal AI Systems Architect @ Neural Bio Labs",
      avatar: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 14, 2026",
      title: "ThinkPad P16 ECC memory saved our quantitative simulations",
      comment: "The ThinkPad P16 Gen 2 is indeed a heavy machine, but the 192GB ECC RAM configuration is the only setup that prevents silent data corruption during 14-hour Monte Carlo and financial risk simulations. Great inclusion of the acoustic dB levels as well.",
      helpful: 28
    }
  ],
  2: [
    {
      name: "Prof. Arthur Pendelton",
      role: "AI Research Fellow @ Oxford Institute of Data",
      avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 16, 2026",
      title: "Masterful historical breakdown of early symbolic vs neural paradigms",
      comment: "Rarely do modern tech publications trace contemporary Transformer architectures back to the Rosenblatt Perceptron and McCarthy's LISP with such mathematical precision. Excellent foundational reading for junior and senior AI fellows alike.",
      helpful: 39
    },
    {
      name: "Dr. Sarah Jenkins",
      role: "Chief Systems Architect @ FinEdge Global",
      avatar: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 15, 2026",
      title: "Essential context for modern LLM architecture designers",
      comment: "Understanding the hardware bottlenecks of the 1950s gives brilliant clarity to why modern matrix multiplication accelerators (TPUs/GPUs) are designed the way they are. The timeline diagrams are remarkably clear.",
      helpful: 27
    },
    {
      name: "Jonathan Anastas",
      role: "Ador Network Services / Chief Marketing Officer",
      avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 14, 2026",
      title: "A brilliant whitepaper our entire executive team enjoyed",
      comment: "Concise, authoritative, and historically rigorous. Helps our board understand how the last 70 years of computational milestones led to current sovereign enterprise models.",
      helpful: 18
    }
  ],
  3: [
    {
      name: "Alex Linetski",
      role: "Lead Cloud Infrastructure Engineer @ HiRefresh Agency",
      avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 16, 2026",
      title: "Cilium eBPF packet routing slashed our P99 API latency by 45%",
      comment: "We implemented Creed Tech's eBPF microservices blueprint directly in our EU cloud cluster. Bypassing iptables completely eliminated connection tracking bottlenecks under 100k concurrent WebSocket connections.",
      helpful: 46
    },
    {
      name: "Vlad Hryhoren",
      role: "VP of Site Reliability @ ScaledCore Systems",
      avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 15, 2026",
      title: "The cleanest zero-downtime canary deployment architecture we've seen",
      comment: "The automated Envoy routing with mTLS 1.3 encryption out of the box passed our external SOC 2 Type II audit with flying colors. A masterclass in Kubernetes production engineering.",
      helpful: 31
    },
    {
      name: "Liam Gallagher",
      role: "VP of Cloud Engineering @ DataScale Global",
      avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 14, 2026",
      title: "Robust multi-tenant isolation and automated pod autoscaling",
      comment: "This saved us weeks of trial and error configuring custom metrics horizontal pod autoscaling. Highly recommended for enterprise SRE teams.",
      helpful: 24
    }
  ]
};

var CURRENT_ACTIVE_ARTICLE_ID = 1;

// Sidebar Navigator Renderer
function renderSidebarNavigator() {
  var list = document.getElementById('sidebarArticlesList');
  if (!list) return;

  list.innerHTML = ARTICLES_STORE.map(function(art) {
    var isActive = (art.id === CURRENT_ACTIVE_ARTICLE_ID);
    return '<button onclick="openDynamicArticle(' + art.id + ', event)" class="kc-sidebar-item' + (isActive ? ' active' : '') + '">' +
      '<div style="display:flex;align-items:center;justify-content:space-between;gap:4px;">' +
        '<span style="font-size:9.5px;font-weight:800;color:#0052FF;text-transform:uppercase;">' + (art.category.split('&')[0]) + '</span>' +
        '<span style="font-size:10.5px;color:#94A3B8;">' + art.read_time + '</span>' +
      '</div>' +
      '<h5 style="font-size:12px;font-weight:700;color:#0F172A;margin:2px 0 0;line-height:1.35;text-align:left;">' + art.title + '</h5>' +
    '</button>';
  }).join('');
}

function filterSidebarArticles(query) {
  var q = (query || '').toLowerCase().trim();
  var items = document.querySelectorAll('#sidebarArticlesList .kc-sidebar-item');
  items.forEach(function(item) {
    if (!q || item.textContent.toLowerCase().includes(q)) {
      item.style.display = 'flex';
    } else {
      item.style.display = 'none';
    }
  });
}

// Load & Render Post-Specific Reviews for Active Article
function loadPostReviews(articleId) {
  var list = document.getElementById('postReviewsList');
  if (!list) return;

  // Try fetching live reviews from backend API, or fallback to memory
  fetch('ajax/article_reviews.php?article_id=' + articleId)
    .then(function(res) { return res.json(); })
    .then(function(data) {
      var reviews = (data && data.reviews && data.reviews.length > 0) ? data.reviews : (POST_REVIEWS_STORE[articleId] || POST_REVIEWS_STORE[1]);
      renderPostReviewsHtml(reviews);
    })
    .catch(function() {
      var fallback = POST_REVIEWS_STORE[articleId] || POST_REVIEWS_STORE[1];
      renderPostReviewsHtml(fallback);
    });
}

function renderPostReviewsHtml(reviews) {
  var list = document.getElementById('postReviewsList');
  if (!list) return;

  if (!reviews || reviews.length === 0) {
    list.innerHTML = '<div style="padding:20px;background:#F8FAFC;border:1px dashed #CBD5E1;border-radius:8px;text-align:center;color:#64748B;font-size:13px;">No reviews submitted yet for this post. Be the first to add your peer review!</div>';
    return;
  }

  // Render top 3 reviews
  var top3 = reviews.slice(0, 3);
  list.innerHTML = top3.map(function(r) {
    var starCount = parseInt(r.rating || 5);
    var starsStr = '★★★★★'.substring(0, starCount) + '☆☆☆☆☆'.substring(0, 5 - starCount);
    var avatarImg = r.avatar || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80';

    return '<div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:10px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,0.02);">' +
      '<div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:10px;">' +
        '<div style="display:flex;align-items:center;gap:12px;">' +
          '<img src="' + avatarImg + '" alt="' + r.name + '" style="width:42px;height:42px;border-radius:50%;object-fit:cover;border:2px solid #E2E8F0;">' +
          '<div>' +
            '<div style="display:flex;align-items:center;gap:6px;">' +
              '<h4 style="font-size:13.5px;font-weight:800;color:#0F172A;margin:0;">' + r.name + '</h4>' +
              '<span style="background:#DCFCE7;color:#15803D;font-size:9.5px;font-weight:800;padding:1px 6px;border-radius:2px;">✓ VERIFIED ARCHITECT</span>' +
            '</div>' +
            '<span style="font-size:11.5px;color:#64748B;font-weight:500;">' + r.role + '</span>' +
          '</div>' +
        '</div>' +
        '<div style="text-align:right;">' +
          '<div style="color:#F59E0B;font-size:13px;letter-spacing:1px;">' + starsStr + '</div>' +
          '<span style="font-size:11px;color:#94A3B8;">' + (r.date || 'Aug 2026') + '</span>' +
        '</div>' +
      '</div>' +
      '<h5 style="font-size:13.5px;font-weight:700;color:#0F172A;margin:0 0 6px;line-height:1.35;">' + (r.title || 'In-Depth Evaluation') + '</h5>' +
      '<p style="font-size:13px;color:#475569;line-height:1.65;margin:0 0 10px;">' + r.comment + '</p>' +
      '<div style="display:flex;align-items:center;justify-content:space-between;padding-top:8px;border-top:1px solid #F8FAFC;font-size:11px;color:#94A3B8;">' +
        '<span>💡 Helpful: ' + (r.helpful || 12) + ' engineers found this constructive</span>' +
        '<button onclick="this.textContent=\'✓ Thank you\';this.style.color=\'#0052FF\';" style="background:transparent;border:none;color:#64748B;cursor:pointer;font-size:11px;font-weight:600;">Helpful?</button>' +
      '</div>' +
    '</div>';
  }).join('');
}

// Add Review Modal Controllers
function openAddReviewModal() {
  var activeArt = ARTICLES_STORE.find(function(a) { return a.id === CURRENT_ACTIVE_ARTICLE_ID; }) || ARTICLES_STORE[0];
  var titleEl = document.getElementById('modalArticleTargetTitle');
  if (titleEl) titleEl.textContent = 'Post: ' + activeArt.title;
  document.getElementById('addReviewModal').style.display = 'flex';
}

function closeAddReviewModal() {
  document.getElementById('addReviewModal').style.display = 'none';
}

function handlePostReviewSubmit(e) {
  e.preventDefault();
  var name = document.getElementById('revInputName').value.trim();
  var role = document.getElementById('revInputRole').value.trim();
  var rating = parseInt(document.getElementById('revInputRating').value || 5);
  var title = document.getElementById('revInputTitle').value.trim();
  var comment = document.getElementById('revInputComment').value.trim();

  var newRevObj = {
    article_id: CURRENT_ACTIVE_ARTICLE_ID,
    name: name,
    role: role,
    rating: rating,
    title: title,
    comment: comment,
    date: 'Just Now',
    helpful: 1
  };

  // Add to local store immediately for instant UI response
  if (!POST_REVIEWS_STORE[CURRENT_ACTIVE_ARTICLE_ID]) {
    POST_REVIEWS_STORE[CURRENT_ACTIVE_ARTICLE_ID] = [];
  }
  POST_REVIEWS_STORE[CURRENT_ACTIVE_ARTICLE_ID].unshift(newRevObj);

  // Send to backend
  fetch('ajax/article_reviews.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(newRevObj)
  }).catch(function(err) { console.warn('Saved in memory:', err); });

  // Re-render post reviews
  renderPostReviewsHtml(POST_REVIEWS_STORE[CURRENT_ACTIVE_ARTICLE_ID]);

  // Reset & Close
  document.getElementById('revInputName').value = '';
  document.getElementById('revInputRole').value = '';
  document.getElementById('revInputTitle').value = '';
  document.getElementById('revInputComment').value = '';
  closeAddReviewModal();

  alert('✓ Thank you, ' + name + '! Your verified peer review has been posted successfully.');
}

// Open Dynamic Article In-Place
function openDynamicArticle(articleId, e) {
  if (e) e.preventDefault();

  var art = ARTICLES_STORE.find(function(a) { return a.id === parseInt(articleId); }) || ARTICLES_STORE[0];
  CURRENT_ACTIVE_ARTICLE_ID = art.id;

  // 1. Hide Overview Grid, Show Expansive 3-Column Reader Layout
  document.getElementById('kcOverviewLayout').style.display = 'none';
  document.getElementById('kcReaderLayout').style.display = 'block';

  // 2. Populate Breadcrumbs
  document.getElementById('readerBreadcrumbCat').textContent = art.category;

  // 3. Populate Header & Metadata
  document.getElementById('readerCatBadge').textContent = art.category;
  document.getElementById('readerDate').textContent = art.date;
  document.getElementById('readerReadTime').textContent = '⏱️ ' + art.read_time;
  document.getElementById('readerTitle').textContent = art.title;
  document.getElementById('readerAuthor').textContent = art.author;

  // 4. Populate Editors Note
  if (art.editors_note) {
    document.getElementById('readerEditorsNoteBox').style.display = 'block';
    document.getElementById('readerEditorsNote').textContent = art.editors_note;
  } else {
    document.getElementById('readerEditorsNoteBox').style.display = 'none';
  }

  // 5. Populate Intro Paragraphs & Source Attribution
  var introContainer = document.getElementById('readerIntroParagraphs');
  if (introContainer) {
    var sourceAttrHtml = '';
    if (art.article_origin === 'news_editorial' && art.source_provider) {
      sourceAttrHtml = '<div style="background:#F8FAFC;border:1px solid #E2E8F0;border-left:4px solid #0052FF;border-radius:6px;padding:14px 18px;margin:0 0 20px;">' +
        '<span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;">Source Attribution &amp; Reference</span>' +
        '<p style="font-size:13px;color:#334155;margin:4px 0 6px;">Based on technical news reported by <strong>' + (art.source_provider.toUpperCase()) + '</strong>: <em>"' + (art.source_title || '') + '"</em>.</p>' +
        '<a href="' + (art.source_url || '#') + '" target="_blank" rel="noopener noreferrer" style="font-size:12px;color:#0052FF;text-decoration:underline;font-weight:600;">Read Original Source Report ↗</a>' +
      '</div>';
    }

    var bodyHtml = '';
    if (art.custom_body_html) {
      bodyHtml = '<div style="font-size:15px;line-height:1.8;color:#334155;">' + art.custom_body_html + '</div>';
    } else if (art.intro_paragraphs && Array.isArray(art.intro_paragraphs)) {
      bodyHtml = art.intro_paragraphs.map(function(p) {
        return '<p style="margin:0 0 16px;line-height:1.8;">' + p + '</p>';
      }).join('');
    }
    introContainer.innerHTML = sourceAttrHtml + bodyHtml;
  }

  // 6. Populate Media (Audio & Video)
  var audioEl = document.getElementById('readerAudioPlayer');
  if (audioEl) {
    audioEl.src = art.audio_url || 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3';
    audioEl.pause();
    document.getElementById('readerPlayBtn').innerHTML = '▶';
  }
  var videoIframe = document.getElementById('readerVideoIframe');
  if (videoIframe) {
    videoIframe.src = art.video_url || 'https://www.youtube.com/embed/dQw4w9WgXcQ?controls=1';
  }

  // 7. Populate Products Breakdown Bento Cards
  var productsContainer = document.getElementById('readerProductsContainer');
  if (productsContainer) {
    if (art.products && art.products.length > 0) {
      productsContainer.innerHTML = art.products.map(function(prod) {
        var prosList = (prod.pros || []).map(function(pro) {
          return '<li style="display:flex;align-items:flex-start;gap:8px;font-size:13px;color:#14532D;line-height:1.5;"><span style="color:#16A34A;font-weight:900;">+</span> <span>' + pro + '</span></li>';
        }).join('');

        var consList = (prod.cons || []).map(function(con) {
          return '<li style="display:flex;align-items:flex-start;gap:8px;font-size:13px;color:#7F1D1D;line-height:1.5;"><span style="color:#DC2626;font-weight:900;">&minus;</span> <span>' + con + '</span></li>';
        }).join('');

        var buyBtns = (prod.buy_links || []).map(function(b) {
          return '<a href="' + (b.url || '#') + '" target="_blank" style="padding:9px 18px;background:' + (b.color || '#0052FF') + ';color:#fff;font-size:12px;font-weight:700;text-decoration:none;border-radius:4px;display:inline-flex;align-items:center;gap:6px;">' + (b.price || b.store) + ' &rarr;</a>';
        }).join(' ');

        var specsHtml = '';
        if (prod.specs) {
          var specRows = Object.keys(prod.specs).map(function(k) {
            return '<tr style="border-bottom:1px solid #F1F5F9;"><td style="padding:8px 12px;font-weight:700;color:#0F172A;width:35%;">' + k + '</td><td style="padding:8px 12px;color:#475569;">' + prod.specs[k] + '</td></tr>';
          }).join('');
          specsHtml = '<table style="width:100%;border-collapse:collapse;font-size:12.5px;margin-top:14px;background:#F8FAFC;border-radius:6px;border:1px solid #E2E8F0;"><tbody>' + specRows + '</tbody></table>';
        }

        return '<div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:12px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,0.02);">' +
          '<div class="kc-prod-grid" style="margin-bottom:20px;">' +
            '<div style="height:200px;border-radius:8px;overflow:hidden;background:#0B1120;">' +
              '<img src="' + prod.image + '" alt="' + prod.name + '" style="width:100%;height:100%;object-fit:cover;">' +
            '</div>' +
            '<div>' +
              '<span style="font-size:11px;font-weight:800;color:#E11D48;text-transform:uppercase;margin-bottom:4px;display:block;">' + prod.award + '</span>' +
              '<h3 style="font-size:1.35rem;font-weight:800;color:#0F172A;margin:0 0 8px;line-height:1.25;">' + prod.name + '</h3>' +
              '<div style="font-size:14px;font-weight:800;color:#0052FF;margin-bottom:12px;">' + (prod.price || 'Verified') + ' &bull; ★★★★★ (' + prod.rating + ')</div>' +
              '<div style="font-size:13.5px;color:#475569;line-height:1.65;">' + (prod.long_text || '<p>' + prod.description + '</p>') + '</div>' +
            '</div>' +
          '</div>' +

          '<div class="kc-procon-grid" style="margin-bottom:18px;">' +
            '<div class="pro-con-card" style="background:#F0FDF4;border:1px solid #86EFAC;">' +
              '<div style="font-size:11px;font-weight:900;color:#166534;text-transform:uppercase;margin-bottom:8px;">PROS (KEY ADVANTAGES)</div>' +
              '<ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:6px;">' + prosList + '</ul>' +
            '</div>' +
            '<div class="pro-con-card" style="background:#FEF2F2;border:1px solid #FECACA;">' +
              '<div style="font-size:11px;font-weight:900;color:#991B1B;text-transform:uppercase;margin-bottom:8px;">CONS (LIMITATIONS)</div>' +
              '<ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:6px;">' + consList + '</ul>' +
            '</div>' +
          '</div>' +

          (specsHtml ? '<div style="margin-bottom:18px;"><div style="font-size:12px;font-weight:800;color:#0F172A;text-transform:uppercase;margin-bottom:6px;">📊 Hardware &amp; Architectural Specifications</div>' + specsHtml + '</div>' : '') +

          (buyBtns ? '<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;padding-top:12px;border-top:1px solid #F1F5F9;">' + buyBtns + '</div>' : '') +
        '</div>';
      }).join('');
    } else {
      productsContainer.innerHTML = '';
    }
  }

  // 8. Load Post-Specific Verified 3 Top Reviews for this active article
  loadPostReviews(art.id);

  // 9. Update Sidebar active states
  renderSidebarNavigator();

  // 10. Update Browser URL
  if (window.history && window.history.pushState) {
    window.history.pushState(null, '', 'knowledge-center.php?id=' + art.id);
  }

  // Smooth scroll down to reader container
  document.getElementById('kcReaderLayout').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Close Reader View and Return to Full Overview Grid
function closeDynamicArticle() {
  document.getElementById('kcReaderLayout').style.display = 'none';
  document.getElementById('kcOverviewLayout').style.display = 'grid';
  if (window.history && window.history.pushState) {
    window.history.pushState(null, '', 'knowledge-center.php');
  }
  document.getElementById('kcOverviewLayout').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Audio Player Handlers for Reader
var readerAudio = document.getElementById('readerAudioPlayer');
var readerPlayBtn = document.getElementById('readerPlayBtn');
var readerScrubber = document.getElementById('readerScrubber');
var readerCurTime = document.getElementById('readerCurTime');
var readerDurTime = document.getElementById('readerDurTime');

function formatAudioTime(s) {
  var m = Math.floor(s / 60);
  var sec = Math.floor(s % 60);
  return (m < 10 ? '0' : '') + m + ':' + (sec < 10 ? '0' : '') + sec;
}

function toggleReaderAudio() {
  if (!readerAudio) return;
  if (readerAudio.paused) {
    readerAudio.play();
    readerPlayBtn.innerHTML = '❚❚';
  } else {
    readerAudio.pause();
    readerPlayBtn.innerHTML = '▶';
  }
}

if (readerAudio) {
  readerAudio.addEventListener('timeupdate', function() {
    if (!isNaN(readerAudio.duration) && readerAudio.duration > 0) {
      readerScrubber.value = (readerAudio.currentTime / readerAudio.duration) * 100;
      readerCurTime.textContent = formatAudioTime(readerAudio.currentTime);
      readerDurTime.textContent = formatAudioTime(readerAudio.duration);
    }
  });

  readerAudio.addEventListener('ended', function() {
    readerPlayBtn.innerHTML = '▶';
    readerScrubber.value = 0;
  });
}

function seekReaderAudio(val) {
  if (readerAudio && !isNaN(readerAudio.duration)) {
    readerAudio.currentTime = (val / 100) * readerAudio.duration;
  }
}

function setReaderSpeed(spd) {
  if (readerAudio) {
    readerAudio.playbackRate = spd;
    ['readerSpd-1', 'readerSpd-15', 'readerSpd-2'].forEach(function(id) {
      var btn = document.getElementById(id);
      if (btn) {
        btn.style.background = '#1E293B';
        btn.style.color = '#94A3B8';
        btn.style.borderColor = '#334155';
      }
    });
    var activeBtn = document.getElementById(spd === 1.0 ? 'readerSpd-1' : (spd === 1.5 ? 'readerSpd-15' : 'readerSpd-2'));
    if (activeBtn) {
      activeBtn.style.background = '#0052FF';
      activeBtn.style.color = '#fff';
      activeBtn.style.borderColor = '#0052FF';
    }
  }
}

function shareActiveArticle(type) {
  if (type === 'copy') {
    navigator.clipboard.writeText(window.location.href);
    alert('✓ Direct link copied to clipboard!');
  }
}

// Brand Wires Controller
var WIRE_DATA = (window.CREED_KC_INIT && window.CREED_KC_INIT.wireData) ? window.CREED_KC_INIT.wireData : {};

var currentWireBrand = 'google';

function selectWireBrand(brand) {
  currentWireBrand = brand;
  var b = (WIRE_DATA && WIRE_DATA[brand]) ? WIRE_DATA[brand] : null;

  var imgEl = document.getElementById('wireImg');
  if (imgEl) {
    var rawImg = b ? (b.img || b.image || b.image_url || b.local_image_path || 'assets/img/hero_img.webp') : 'assets/img/hero_img.webp';
    imgEl.src = rawImg;
    imgEl.alt = b ? (b.title || 'News Story Photo') : 'No verified item available';
    imgEl.style.width = '100%';
    imgEl.style.height = '100%';
    imgEl.style.objectFit = 'cover';
    imgEl.style.objectPosition = 'center';
    imgEl.style.display = 'block';
    imgEl.onerror = function() {
      this.onerror = null;
      this.src = 'assets/img/hero_img.webp';
    };
  }
  var brandBadge = document.getElementById('wireBrandBadge');
  if (brandBadge) {
    brandBadge.textContent = b ? (b.brandBadge || brand.toUpperCase()) : (brand ? brand.toUpperCase() : 'WIRE');
  }
  var captionTag = document.getElementById('wireCaptionTag');
  if (captionTag) {
    captionTag.textContent = b ? (b.captionTag || 'OFFICIAL WIRE') : 'UNAVAILABLE';
  }
  var captionText = document.getElementById('wireCaptionText');
  if (captionText) {
    captionText.textContent = b ? (b.caption || ('📷 ' + (b.title || ''))) : '📷 No verified item available';
  }

  if (document.getElementById('wireCat')) document.getElementById('wireCat').textContent = b ? (b.cat || b.category || 'OFFICIAL WIRE') : 'OFFICIAL WIRE';
  if (document.getElementById('wireDate')) document.getElementById('wireDate').textContent = b ? (b.date || '') : '';
  if (document.getElementById('wireTitle')) document.getElementById('wireTitle').textContent = b ? (b.title || 'No verified item available') : 'No verified item available';
  if (document.getElementById('wireSummary')) document.getElementById('wireSummary').textContent = b ? (b.summary || b.desc || 'No verified item available for this provider.') : 'No verified item available for this provider.';
  if (document.getElementById('wireSourceName')) document.getElementById('wireSourceName').textContent = b ? (b.source || b.sourceName || '') : '';
  if (document.getElementById('wireSourceBtn')) {
    if (b && (b.link || b.sourceUrl)) {
      document.getElementById('wireSourceBtn').href = b.link || b.sourceUrl;
      document.getElementById('wireSourceBtn').style.display = 'inline-flex';
    } else {
      document.getElementById('wireSourceBtn').removeAttribute('href');
      document.getElementById('wireSourceBtn').style.display = 'none';
    }
  }

  var tabs = document.querySelectorAll('#intlWireTabsContainer .wire-tab-btn, .wire-tab-btn');
  tabs.forEach(function(el) {
    var p = el.getAttribute('data-provider') || (el.id ? el.id.replace('wireBtn-', '') : '');
    if (p === brand) {
      el.classList.add('tab-active');
      el.style.background = '#0052FF';
      el.style.color = '#fff';
    } else {
      el.classList.remove('tab-active');
      el.style.background = '#F1F5F9';
      el.style.color = '#475569';
    }
  });
}

// Breaking News Carousel (5 Verified Live Provider Stories)
var MAIN_NEWS_LIST = (window.CREED_KC_INIT && Array.isArray(window.CREED_KC_INIT.mainNewsList)) ? window.CREED_KC_INIT.mainNewsList : [];

function switchMainNews(idx) {
  var item = MAIN_NEWS_LIST[idx];
  if (!item) return;
  var imgEl = document.getElementById('mainNewsImg');
  if (imgEl) {
    var rawImg = item.img || item.image || item.image_url || item.urlToImage || 'assets/img/hero_img.webp';
    imgEl.src = rawImg;
    imgEl.onerror = function() {
      this.onerror = null;
      this.src = 'assets/img/hero_img.webp';
    };
  }
  if (document.getElementById('mainNewsTag')) document.getElementById('mainNewsTag').textContent = item.tag || '';
  if (document.getElementById('mainNewsDate')) document.getElementById('mainNewsDate').textContent = item.date || '';
  if (document.getElementById('mainNewsSource')) document.getElementById('mainNewsSource').textContent = item.source || '';
  if (document.getElementById('mainNewsTitle')) document.getElementById('mainNewsTitle').textContent = item.title || '';
  if (document.getElementById('mainNewsDesc')) document.getElementById('mainNewsDesc').textContent = item.desc || '';
  if (document.getElementById('mainNewsLink') && item.link) document.getElementById('mainNewsLink').href = item.link;
}

function renderBreakingNewsList(list) {
  if (!list || !list.length) return;
  MAIN_NEWS_LIST = list;
  switchMainNews(0);

  var sideContainer = document.getElementById('sideNewsContainer');
  if (!sideContainer) return;

  var providerBadges = {
    apple:        { color: '#0284C7', label: '🍎 APPLE • HARDWARE & SILICON' },
    openai:       { color: '#7C3AED', label: '🤖 OPENAI • AI REASONING' },
    nvidia:       { color: '#059669', label: '⚡ NVIDIA • ACCELERATED AI' },
    anthropic:    { color: '#D97706', label: '🧠 ANTHROPIC • SAFETY RESEARCH' },
    google:       { color: '#0052FF', label: '🌐 GOOGLE • AI & DEVICES' },
    meta:         { color: '#0081FB', label: '♾️ META • OPEN SOURCE AI' },
    microsoft:    { color: '#00A4EF', label: '🪟 MICROSOFT • CLOUD & COPILOT' },
    intel:        { color: '#0071C5', label: '🔷 INTEL • NEXT-GEN SILICON' },
    dawn:         { color: '#059669', label: '🇵🇰 DAWN • TECH & SCIENCE' },
    brecorder:    { color: '#0284C7', label: '🇵🇰 B-RECORDER • FINTECH' },
    propakistani: { color: '#D97706', label: '🇵🇰 PROPAKISTANI • DIGITAL ECOSYSTEM' },
    tribune:      { color: '#DC2626', label: '🇵🇰 TRIBUNE • AEROSPACE & TECH' }
  };

  var html = '';
  for (var i = 1; i < Math.min(7, list.length); i++) {
    var s = list[i];
    var pKey = (s.provider || '').toLowerCase();
    var pBadge = providerBadges[pKey] || { color: '#475569', label: pKey.toUpperCase() };
    var img = s.img || s.image || s.image_url || 'assets/img/hero_img.webp';

    html += '<div onclick="switchMainNews(' + i + ')" style="background:#fff;border:1px solid #E2E8F0;border-radius:0.65rem;padding:0.75rem 0.9rem;cursor:pointer;transition:all 0.2s;box-shadow:0 1px 3px rgba(0,0,0,0.04);width:100%;box-sizing:border-box;" onmouseover="this.style.borderColor=\'#0052FF\';this.style.transform=\'translateY(-1px)\'" onmouseout="this.style.borderColor=\'#E2E8F0\';this.style.transform=\'none\'">' +
      '<div style="display:flex;gap:0.75rem;align-items:center;">' +
        '<div style="width:3.75rem;height:3.75rem;border-radius:6px;overflow:hidden;background:#0B1120;flex-shrink:0;">' +
          '<img src="' + img + '" alt="' + (s.title ? s.title.replace(/"/g, '&quot;') : '') + '" style="width:100%;height:100%;object-fit:cover;" onerror="this.onerror=null;this.src=\'assets/img/hero_img.webp\';">' +
        '</div>' +
        '<div style="flex:1;min-width:0;">' +
          '<span style="font-size:9.5px;font-weight:800;color:' + pBadge.color + ';text-transform:uppercase;letter-spacing:0.04em;display:block;margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' + pBadge.label + '</span>' +
          '<h4 style="font-size:0.84rem;font-weight:700;color:#0F172A;line-height:1.3;margin:0 0 2px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">' + (s.title || '') + '</h4>' +
          '<span style="font-size:10.5px;color:#64748B;">' + (s.date || '') + '</span>' +
        '</div>' +
      '</div>' +
    '</div>';
  }
  sideContainer.innerHTML = html;
}

// Pakistan Regional Tech Wire Controller (Verified Real Feeds)
var REGIONAL_DATA = (window.CREED_KC_INIT && window.CREED_KC_INIT.regionalData) ? window.CREED_KC_INIT.regionalData : {};

var currentRegionalTab = 'dawn';

function selectRegionalTab(tab) {
  currentRegionalTab = tab;
  var r = (REGIONAL_DATA && REGIONAL_DATA[tab]) ? REGIONAL_DATA[tab] : null;

  var imgEl = document.getElementById('regImg');
  if (imgEl) {
    var rawImg = r ? (r.image || r.img || r.image_url || r.local_image_path || 'assets/img/hero_img.webp') : 'assets/img/hero_img.webp';
    imgEl.src = rawImg;
    imgEl.alt = r ? (r.title || 'Regional Story Photo') : 'No verified item available';
    imgEl.style.width = '100%';
    imgEl.style.height = '100%';
    imgEl.style.objectFit = 'cover';
    imgEl.style.objectPosition = 'center';
    imgEl.style.display = 'block';
    imgEl.onerror = function() {
      this.onerror = null;
      this.src = 'assets/img/hero_img.webp';
    };
  }
  var brandBadge = document.getElementById('regBrandBadge');
  if (brandBadge) {
    brandBadge.textContent = r ? (r.brandBadge || tab.toUpperCase()) : (tab ? tab.toUpperCase() : 'REGIONAL');
  }
  var captionTag = document.getElementById('regCaptionTag');
  if (captionTag) {
    captionTag.textContent = r ? (r.captionTag || 'PAKISTAN TECH') : 'UNAVAILABLE';
  }
  var captionText = document.getElementById('regCaptionText');
  if (captionText) {
    captionText.textContent = r ? (r.caption || ('📷 ' + (r.title || ''))) : '📷 No verified item available';
  }

  if (document.getElementById('regCat')) document.getElementById('regCat').textContent = r ? (r.category || r.cat || 'PAKISTAN TECH') : 'PAKISTAN TECH';
  if (document.getElementById('regDate')) document.getElementById('regDate').textContent = r ? (r.date || '') : '';
  if (document.getElementById('regTitle')) document.getElementById('regTitle').textContent = r ? (r.title || 'No verified item available') : 'No verified item available';
  if (document.getElementById('regSummary')) document.getElementById('regSummary').textContent = r ? (r.summary || r.desc || 'No verified item available for this provider.') : 'No verified item available for this provider.';
  if (document.getElementById('regSourceName')) document.getElementById('regSourceName').textContent = r ? (r.sourceName || r.source || '') : '';
  if (document.getElementById('regSourceBtn')) {
    if (r && (r.sourceUrl || r.link)) {
      document.getElementById('regSourceBtn').href = r.sourceUrl || r.link;
      document.getElementById('regSourceBtn').style.display = 'inline-flex';
    } else {
      document.getElementById('regSourceBtn').removeAttribute('href');
      document.getElementById('regSourceBtn').style.display = 'none';
    }
  }

  var tabs = document.querySelectorAll('#pakWireTabsContainer .reg-tab-btn, .reg-tab-btn');
  tabs.forEach(function(el) {
    var p = el.getAttribute('data-provider') || (el.id ? el.id.replace('regBtn-', '') : '');
    if (p === tab) {
      el.classList.add('tab-active');
      el.style.background = '#059669';
      el.style.color = '#fff';
      el.style.border = 'none';
      el.style.boxShadow = '0 4px 6px -1px rgba(5,150,105,0.3)';
    } else {
      el.classList.remove('tab-active');
      el.style.background = '#fff';
      el.style.color = '#475569';
      el.style.border = '1px solid #CBD5E1';
      el.style.boxShadow = 'none';
    }
  });
}

// Topic Filter Controller (Strictly targets Category Directory; Trending remains independent)
function filterTopic(topic) {
  ['ALL','SEO','Hosting','Social','AI & Cloud','DevOps'].forEach(function(t) {
    var btn = document.getElementById('topicBtn-' + t);
    if (!btn) return;
    if (t === topic) {
      btn.style.background = '#0052FF';
      btn.style.color = '#fff';
    } else {
      btn.style.background = '#F1F5F9';
      btn.style.color = '#475569';
    }
  });

  var cards = document.querySelectorAll('#topicCardsGrid .topic-card-item');
  cards.forEach(function(c) {
    var t = c.getAttribute('data-topic');
    if (topic === 'ALL' || t === topic) {
      c.style.display = 'block';
    } else {
      c.style.display = 'none';
    }
  });
}

// =========================================================
// RIGHT SIDEBAR INTERACTIVE SLIDERS (Top Stories, Videos, Events)
// =========================================================
var SIDEBAR_STORIES_PAGES = [
  [
    { id: 1, icon: '💻', iconBg: '#1E293B', title: 'The 7 Best Enterprise AI &amp; Cloud Laptops in 2026', date: '15-Aug-2026' },
    { id: 2, icon: '🤖', iconBg: '#312E81', title: 'Artificial Intelligence Development: Modern AI Foundations', date: '18-Aug-2026' },
    { id: 3, icon: '📈', iconBg: '#0F766E', title: 'International Growth &amp; High-Throughput Cloud Scaling', date: '25-Apr-2026' }
  ],
  [
    { id: 2, icon: '🛡️', iconBg: '#7C2D12', title: 'Autonomous Neural Threat Detection &amp; Zero Trust', date: '12-Aug-2026' },
    { id: 1, icon: '⚡', iconBg: '#0369A1', title: 'High-Performance eBPF Network Mesh Routing', date: '08-Aug-2026' },
    { id: 3, icon: '🌐', iconBg: '#4338CA', title: 'Distributed Multi-Region Cloud Database Replication', date: '05-Aug-2026' }
  ],
  [
    { id: 1, icon: '🧠', iconBg: '#15803D', title: 'LLM Inference Latency Optimization at 120k TPS', date: '01-Aug-2026' },
    { id: 2, icon: '🔐', iconBg: '#6B21A8', title: 'Post-Quantum Cryptography Enterprise Standards', date: '28-Jul-2026' },
    { id: 3, icon: '🚀', iconBg: '#9D174D', title: 'Container Orchestration &amp; Microservices Governance', date: '22-Jul-2026' }
  ]
];

var SIDEBAR_VIDEOS_PAGES = [
  [
    { title: 'WHAT ARE SOCIAL ADVERTISING?', date: '25-Apr-2024' },
    { title: 'ENTERPRISE AI ARCHITECTURE', date: '18-Apr-2024' },
    { title: 'HYBRID CLOUD DEVOPS TEARDOWN', date: '12-May-2024' }
  ],
  [
    { title: 'KUBERNETES AT 10M DAU: LESSONS LEARNED', date: '04-Jun-2024' },
    { title: 'MODERN CI/CD PIPELINE SECURITY HARDENING', date: '22-May-2024' },
    { title: 'GRAPHQL VS REST IN HIGH-THROUGHPUT SYSTEMS', date: '15-May-2024' }
  ],
  [
    { title: 'EVALUATING OPEN SOURCE LLMS FOR ENTERPRISE', date: '10-Jul-2024' },
    { title: 'DATABASE SHARDING &amp; ZERO-DOWNTIME MIGRATION', date: '29-Jun-2024' },
    { title: 'EVENT-DRIVEN ARCHITECTURES WITH KAFKA', date: '18-Jun-2024' }
  ]
];

var SIDEBAR_EVENTS_PAGES = [
  [
    { day: '13', month: 'APR', title: 'International Conference on World Cloud Architecture', date: '25-Apr-2026' },
    { day: '28', month: 'MAY', title: 'Global AI &amp; Autonomous Agents Summit 2026', date: '28-May-2026' },
    { day: '15', month: 'JUN', title: 'Enterprise Cybersecurity &amp; Threat Modeling Workshop', date: '15-Jun-2026' }
  ],
  [
    { day: '22', month: 'JUL', title: 'Silicon &amp; Accelerated Computing Expo 2026', date: '22-Jul-2026' },
    { day: '18', month: 'AUG', title: 'Next-Gen Microservices &amp; Cloud Native Forum', date: '18-Aug-2026' },
    { day: '09', month: 'SEP', title: 'Global Tech Leadership &amp; Founder Round Table', date: '09-Sep-2026' }
  ],
  [
    { day: '14', month: 'OCT', title: 'Enterprise Data Mesh &amp; Real-time Analytics Summit', date: '14-Oct-2026' },
    { day: '05', month: 'NOV', title: 'AI Safety, Governance &amp; Alignment World Congress', date: '05-Nov-2026' },
    { day: '12', month: 'DEC', title: 'Annual Global Software Architecture Conference', date: '12-Dec-2026' }
  ]
];

var currentStoriesPage = 0;
var currentVideosPage = 0;
var currentEventsPage = 0;

function renderStoriesWidget() {
  var containers = document.querySelectorAll('.sidebar-top-stories-list');
  var page = SIDEBAR_STORIES_PAGES[currentStoriesPage];
  containers.forEach(function(c) {
    c.style.opacity = '0';
    setTimeout(function() {
      c.innerHTML = page.map(function(item, idx) {
        return '<a href="blog_detail?id=' + item.id + '" onclick="openDynamicArticle(' + item.id + ', event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;' + (idx > 0 ? 'padding-top:0.5rem;border-top:1px solid #F9FAFB;' : '') + '">' +
          '<div style="width:3.5rem;height:3.5rem;border-radius:8px;background:' + item.iconBg + ';flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">' + item.icon + '</div>' +
          '<div>' +
            '<h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">' + item.title + '</h5>' +
            '<span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">' + item.date + '</span>' +
          '</div>' +
        '</a>';
      }).join('');
      c.style.opacity = '1';
    }, 120);
  });
}

function renderVideosWidget() {
  var containers = document.querySelectorAll('.sidebar-videos-list');
  var page = SIDEBAR_VIDEOS_PAGES[currentVideosPage];
  containers.forEach(function(c) {
    c.style.opacity = '0';
    setTimeout(function() {
      c.innerHTML = page.map(function(item) {
        return '<div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">' +
          '<div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform=\'scale(1.08)\'" onmouseout="this.style.transform=\'scale(1)\'">▶</div>' +
          '<div>' +
            '<h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">' + item.title + '</h5>' +
            '<span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">' + item.date + '</span>' +
          '</div>' +
        '</div>';
      }).join('');
      c.style.opacity = '1';
    }, 120);
  });
}

function renderEventsWidget() {
  var containers = document.querySelectorAll('.sidebar-events-list');
  var page = SIDEBAR_EVENTS_PAGES[currentEventsPage];
  containers.forEach(function(c) {
    c.style.opacity = '0';
    setTimeout(function() {
      c.innerHTML = page.map(function(item) {
        return '<div onclick="openEventModal(\'' + item.title.replace(/'/g, "\\'") + '\')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">' +
          '<div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">' +
            '<span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">' + item.day + '</span>' +
            '<span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">' + item.month + '</span>' +
          '</div>' +
          '<div>' +
            '<h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">' + item.title + '</h5>' +
            '<span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">' + item.date + '</span>' +
          '</div>' +
        '</div>';
      }).join('');
      c.style.opacity = '1';
    }, 120);
  });
}

function prevTopStories() {
  currentStoriesPage = (currentStoriesPage - 1 + SIDEBAR_STORIES_PAGES.length) % SIDEBAR_STORIES_PAGES.length;
  renderStoriesWidget();
}
function nextTopStories() {
  currentStoriesPage = (currentStoriesPage + 1) % SIDEBAR_STORIES_PAGES.length;
  renderStoriesWidget();
}

function prevVideos() {
  currentVideosPage = (currentVideosPage - 1 + SIDEBAR_VIDEOS_PAGES.length) % SIDEBAR_VIDEOS_PAGES.length;
  renderVideosWidget();
}
function nextVideos() {
  currentVideosPage = (currentVideosPage + 1) % SIDEBAR_VIDEOS_PAGES.length;
  renderVideosWidget();
}

function prevEvents() {
  currentEventsPage = (currentEventsPage - 1 + SIDEBAR_EVENTS_PAGES.length) % SIDEBAR_EVENTS_PAGES.length;
  renderEventsWidget();
}
function nextEvents() {
  currentEventsPage = (currentEventsPage + 1) % SIDEBAR_EVENTS_PAGES.length;
  renderEventsWidget();
}

// =========================================================
// 3D STACKED BADGE TESTIMONIALS (Persistent DOM Motion Deck)
// =========================================================
var DECK_ITEMS = [
  {
    company: "SQUIRE",
    quote: "Robin and Creed Tech consistently deliver clean, intuitive designs that strike the perfect balance between aesthetic and usability. Whether it's for a complex workflow or a lightweight self-service feature, the user experience always feels effortless and refined.",
    author: "Dave Salvant",
    role: "Co-Founder of Squire",
    avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  },
  {
    company: "HIREFRESH",
    quote: "It's always an extraordinary pleasure working with Creed Tech. They bring 100% engineering rigor to each milestone and execute mission-critical cloud workflows when they are needed the most.",
    author: "Vlad Hryhoren",
    role: "UX/UI Director @ HiRefresh",
    avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  },
  {
    company: "ADOR NETWORK",
    quote: "We engaged Creed Tech with the goal of scaling our high-throughput transactional infrastructure. Their team was extraordinary in orchestrating zero-downtime microservices and cloud automation.",
    author: "Jonathan Anastas",
    role: "Chief Marketing Officer @ Ador",
    avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  },
  {
    company: "COGNITIVE HEALTH",
    quote: "Crystal-clear documentation, transparent code audits, and proactive communication. Finding rigorously tested enterprise AI and data synchronization capabilities like this is extraordinarily rare.",
    author: "Elena Rostova",
    role: "AI Product Lead @ Cognitive Health",
    avatar: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  },
  {
    company: "CLOUDNATIVE GLOBAL",
    quote: "Creed Tech has an amazing squad of principal engineers. They possess deep, practical mastery over modern cloud topologies, eBPF routing, and deliver rock-solid results on every sprint.",
    author: "Alex Linetski",
    role: "Principal SRE Architect @ CloudNative",
    avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  }
];

var deckActiveIndex = 0;
var deckTimer = null;
var isDeckPaused = false;
var isDeckBusy = false;

// Initial Setup: Render permanent cards in DOM once
function initDeckCards() {
  var container = document.getElementById('deckCardsContainer');
  if (!container) return;

  container.innerHTML = DECK_ITEMS.map(function(c, idx) {
    return '<div id="deckCardItem-' + idx + '" class="deck-card-elem" onclick="nextDeckCard(event)" style="position:absolute;top:0;left:0;right:0;background:#FFFFFF;border-radius:20px;padding:36px 42px;border:1px solid #E5E7EB;box-sizing:border-box;user-select:none;text-align:left;will-change:transform,opacity;cursor:pointer;">' +
      '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">' +
        '<span style="font-size:1.3rem;font-weight:900;letter-spacing:0.04em;color:#0F172A;text-transform:uppercase;font-family:Impact, \'Arial Black\', -apple-system, sans-serif;">' + c.company + '</span>' +
        '<span style="color:#94A3B8;font-size:18px;letter-spacing:3px;">•••</span>' +
      '</div>' +
      '<div style="font-size:2.25rem;color:#0F172A;line-height:1;margin-bottom:12px;font-family:Georgia, serif;font-weight:900;">&ldquo;</div>' +
      '<p style="font-size:15px;color:#334155;line-height:1.75;margin:0 0 24px;font-weight:400;min-height:76px;">' + c.quote + '</p>' +
      '<div style="display:flex;align-items:center;justify-content:space-between;padding-top:18px;border-top:1px solid #F1F5F9;">' +
        '<div style="display:flex;align-items:center;gap:14px;">' +
          '<img src="' + c.avatar + '" alt="' + c.author + '" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid #F1F5F9;box-shadow:0 1px 3px rgba(0,0,0,0.06);">' +
          '<div>' +
            '<h4 style="font-size:14.5px;font-weight:800;color:#0F172A;margin:0 0 2px;">' + c.author + '</h4>' +
            '<span style="font-size:12px;color:#64748B;font-weight:500;">' + c.role + '</span>' +
          '</div>' +
        '</div>' +
        '<a href="' + (c.linkedin || '#') + '" target="_blank" onclick="event.stopPropagation()" style="width:34px;height:34px;border-radius:8px;background:#F1F5F9;display:flex;align-items:center;justify-content:center;color:#0A66C2;font-weight:800;font-size:14px;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background=\'#E2E8F0\'" onmouseout="this.style.background=\'#F1F5F9\'">in</a>' +
      '</div>' +
    '</div>';
  }).join('');

  applyDeckStackTransforms(false);
  renderDeckDots();
}

// Apply transform styles to all cards based on their relative stack position
function applyDeckStackTransforms(withTransition) {
  var total = DECK_ITEMS.length;
  var transStyle = withTransition ? 'transform 0.85s cubic-bezier(0.2, 0.9, 0.3, 1), opacity 0.7s ease, box-shadow 0.7s ease' : 'none';

  for (var i = 0; i < total; i++) {
    var el = document.getElementById('deckCardItem-' + i);
    if (!el) continue;

    // Relative position from active index (0 = front, 1 = middle, 2 = back, etc.)
    var relPos = (i - deckActiveIndex + total) % total;

    el.style.transition = transStyle;

    if (relPos === 0) {
      // Front Active Card
      el.style.transform = 'translate3d(0, 0, 0) scale(1) rotate(0deg)';
      el.style.opacity = '1';
      el.style.zIndex = '10';
      el.style.boxShadow = '0 25px 50px -12px rgba(0,0,0,0.12), 0 1px 3px rgba(0,0,0,0.05)';
      el.style.pointerEvents = 'auto';
    } else if (relPos === 1) {
      // Second Card (Middle Stack)
      el.style.transform = 'translate3d(0, 18px, -40px) scale(0.96) rotate(-2deg)';
      el.style.opacity = '0.9';
      el.style.zIndex = '8';
      el.style.boxShadow = '0 16px 32px -8px rgba(0,0,0,0.08)';
      el.style.pointerEvents = 'none';
    } else if (relPos === 2) {
      // Third Card (Back Stack)
      el.style.transform = 'translate3d(0, 36px, -80px) scale(0.92) rotate(2deg)';
      el.style.opacity = '0.68';
      el.style.zIndex = '6';
      el.style.boxShadow = '0 10px 20px -6px rgba(0,0,0,0.04)';
      el.style.pointerEvents = 'none';
    } else {
      // Hidden Queue Cards
      el.style.transform = 'translate3d(0, 48px, -120px) scale(0.88) rotate(0deg)';
      el.style.opacity = '0';
      el.style.zIndex = '2';
      el.style.boxShadow = 'none';
      el.style.pointerEvents = 'none';
    }
  }

  renderDeckDots();
}

// Reset and Restart the Autoplay Timer after user interactions
function resetDeckTimer() {
  if (deckTimer) {
    clearInterval(deckTimer);
    deckTimer = null;
  }
  startDeckAutoRotate();
}

// Fluid Card Slide-Out to Back Motion
function nextDeckCard(e) {
  if (e) {
    e.stopPropagation();
    resetDeckTimer();
  }
  if (isDeckBusy) return;
  isDeckBusy = true;

  var total = DECK_ITEMS.length;
  var curFrontIdx = deckActiveIndex;
  var nextActiveIdx = (deckActiveIndex + 1) % total;
  var frontEl = document.getElementById('deckCardItem-' + curFrontIdx);

  if (frontEl) {
    // Phase 1 (0ms - 400ms): Front card slides out smoothly
    frontEl.style.transition = 'transform 0.55s cubic-bezier(0.2, 0.85, 0.35, 1), opacity 0.5s ease, box-shadow 0.5s ease';
    frontEl.style.transform = 'translate3d(160px, -25px, 60px) rotate(10deg) scale(1.02)';
    frontEl.style.boxShadow = '0 35px 70px -15px rgba(0,0,0,0.18)';
    frontEl.style.zIndex = '20';

    // Other cards glide forward into their next stack slot
    for (var i = 0; i < total; i++) {
      if (i === curFrontIdx) continue;
      var el = document.getElementById('deckCardItem-' + i);
      if (!el) continue;

      var newRelPos = (i - nextActiveIdx + total) % total;
      el.style.transition = 'transform 0.75s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.65s ease, box-shadow 0.65s ease';

      if (newRelPos === 0) {
        el.style.transform = 'translate3d(0, 0, 0) scale(1) rotate(0deg)';
        el.style.opacity = '1';
        el.style.zIndex = '10';
        el.style.boxShadow = '0 25px 50px -12px rgba(0,0,0,0.12), 0 1px 3px rgba(0,0,0,0.05)';
        el.style.pointerEvents = 'auto';
      } else if (newRelPos === 1) {
        el.style.transform = 'translate3d(0, 18px, -40px) scale(0.96) rotate(-2deg)';
        el.style.opacity = '0.9';
        el.style.zIndex = '8';
        el.style.boxShadow = '0 16px 32px -8px rgba(0,0,0,0.08)';
        el.style.pointerEvents = 'none';
      } else if (newRelPos === 2) {
        el.style.transform = 'translate3d(0, 36px, -80px) scale(0.92) rotate(2deg)';
        el.style.opacity = '0.68';
        el.style.zIndex = '6';
        el.style.boxShadow = '0 10px 20px -6px rgba(0,0,0,0.04)';
        el.style.pointerEvents = 'none';
      } else {
        el.style.transform = 'translate3d(0, 48px, -120px) scale(0.88) rotate(0deg)';
        el.style.opacity = '0';
        el.style.zIndex = '2';
        el.style.boxShadow = 'none';
        el.style.pointerEvents = 'none';
      }
    }

    // Phase 2 (380ms): Drop behind stack into back slot
    setTimeout(function() {
      if (frontEl) {
        frontEl.style.transition = 'transform 0.55s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.5s ease, box-shadow 0.5s ease';
        frontEl.style.zIndex = '4';
        frontEl.style.transform = 'translate3d(0, 36px, -80px) scale(0.92) rotate(2deg)';
        frontEl.style.opacity = '0.68';
        frontEl.style.boxShadow = '0 10px 20px -6px rgba(0,0,0,0.04)';
        frontEl.style.pointerEvents = 'none';
      }
    }, 380);

    // Phase 3 (850ms): Finalize state
    setTimeout(function() {
      deckActiveIndex = nextActiveIdx;
      applyDeckStackTransforms(false);
      isDeckBusy = false;
    }, 850);

  } else {
    deckActiveIndex = nextActiveIdx;
    applyDeckStackTransforms(true);
    isDeckBusy = false;
  }
}

function prevDeckCard(e) {
  if (e) e.stopPropagation();
  resetDeckTimer();
  if (isDeckBusy) return;
  isDeckBusy = true;
  deckActiveIndex = (deckActiveIndex - 1 + DECK_ITEMS.length) % DECK_ITEMS.length;
  applyDeckStackTransforms(true);
  setTimeout(function() { isDeckBusy = false; }, 800);
}

function jumpToDeckCard(idx, e) {
  if (e) e.stopPropagation();
  resetDeckTimer();
  if (isDeckBusy || idx === deckActiveIndex) return;
  isDeckBusy = true;
  deckActiveIndex = idx;
  applyDeckStackTransforms(true);
  setTimeout(function() { isDeckBusy = false; }, 800);
}

function renderDeckDots() {
  var dotsContainer = document.getElementById('deckProgressDots');
  if (!dotsContainer) return;
  var total = DECK_ITEMS.length;
  var html = '';
  for (var i = 0; i < total; i++) {
    var isActive = (i === deckActiveIndex);
    html += '<span onclick="jumpToDeckCard(' + i + ', event)" style="display:inline-block;height:4px;width:' + (isActive ? '26px' : '9px') + ';background:' + (isActive ? '#0F172A' : '#CBD5E1') + ';cursor:pointer;border-radius:2px;transition:all 0.35s ease;"></span>';
  }
  dotsContainer.innerHTML = html;
}

function startDeckAutoRotate() {
  if (deckTimer) {
    clearInterval(deckTimer);
    deckTimer = null;
  }
  // Smooth auto-slide every 3.8 seconds
  deckTimer = setInterval(function() {
    if (!isDeckPaused && !document.hidden) {
      nextDeckCard();
    }
  }, 3800);
}

// Modals
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

// Fetch Live Tech Feeds API (Continuous Live Background Polling)
async function fetchLiveNewsAPI() {
  try {
    const res = await fetch('/ajax/live_tech_news.php?t=' + Date.now());
    if (!res.ok) return;
    const data = await res.json();
    if (data.status === 'success') {
      if (data.brand_wires && Object.keys(data.brand_wires).length > 0) {
        WIRE_DATA = data.brand_wires;
        selectWireBrand(currentWireBrand);
      }
      if (data.regional_wires && Object.keys(data.regional_wires).length > 0) {
        REGIONAL_DATA = data.regional_wires;
        selectRegionalTab(currentRegionalTab);
      }
      if (data.breaking_news && Array.isArray(data.breaking_news) && data.breaking_news.length > 0) {
        renderBreakingNewsList(data.breaking_news);
      }
    }
  } catch (err) {
    console.log('Live news API fallback active:', err);
  }
}

// DOM Ready
document.addEventListener('DOMContentLoaded', function() {
  renderSidebarNavigator();
  initDeckCards();
  startDeckAutoRotate();

  // Only pause when hovering directly over the card deck, not the entire page section
  var deckWrap = document.getElementById('badgeDeckWrapper') || document.getElementById('deckCardsContainer');
  if (deckWrap) {
    deckWrap.addEventListener('mouseenter', function() { isDeckPaused = true; });
    deckWrap.addEventListener('mouseleave', function() { isDeckPaused = false; resetDeckTimer(); });
  }

  document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
      isDeckPaused = true;
    } else {
      isDeckPaused = false;
      resetDeckTimer();
    }
  });

  // IntersectionObserver to ensure autoplay resumes whenever user scrolls to the reviews section
  if ('IntersectionObserver' in window) {
    var obsTarget = document.getElementById('reviewCarouselSection');
    if (obsTarget) {
      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            isDeckPaused = false;
            resetDeckTimer();
          }
        });
      }, { threshold: 0.15 });
      observer.observe(obsTarget);
    }
  }

  // Bind International Wire Tabs with scoped event delegation
  var intlContainer = document.getElementById('intlWireTabsContainer');
  if (intlContainer) {
    intlContainer.addEventListener('click', function(e) {
      var btn = e.target.closest('.wire-tab-btn, button[data-provider]');
      if (btn) {
        var provider = btn.getAttribute('data-provider');
        if (provider) selectWireBrand(provider);
      }
    });
  }

  // Bind Pakistani Regional Wire Tabs with scoped event delegation
  var pakContainer = document.getElementById('pakWireTabsContainer');
  if (pakContainer) {
    pakContainer.addEventListener('click', function(e) {
      var btn = e.target.closest('.reg-tab-btn, button[data-provider]');
      if (btn) {
        var provider = btn.getAttribute('data-provider');
        if (provider) selectRegionalTab(provider);
      }
    });
  }

  // Initial live news fetch
  fetchLiveNewsAPI();

  // Real-time Background Auto-Update: Polls live API every 60 seconds automatically
  setInterval(fetchLiveNewsAPI, 60000);

  var urlParams = new URLSearchParams(window.location.search);
  var targetId = urlParams.get('id');
  if (targetId) {
    openDynamicArticle(parseInt(targetId));
  }
});
