<?php
require_once __DIR__ . '/includes/db.php';

$page_title = "Database Architecture & Optimization | Creed Tech";
$page_description = "Scalable relational and NoSQL database architecture, query optimization, high-availability clustering, and zero-downtime data migrations.";
$active_page = "database";

include __DIR__ . '/includes/header.php';
?>

<!-- ======= Database Hero ======= -->
<section class="hero-wrapper">
  <div class="creed-container">
    <div class="hero-grid">
      
      <div class="hero-content">
        <span class="section-tag section-tag-accent"><i class="bi bi-database-fill-gear"></i> Data Infrastructure</span>
        <h1>Scalable <span class="highlight">Database</span> Architecture & Optimization</h1>
        <p class="hero-lead">
          We architect fault-tolerant data storage engines that maximize query throughput, guarantee absolute data integrity, and scale effortlessly under high concurrent loads.
        </p>
        <div class="hero-actions">
          <a href="contact" class="btn-creed btn-creed-accent"><i class="bi bi-chat-dots-fill"></i> Consult Database Architect</a>
          <a href="#capabilities" class="btn-creed btn-creed-outline"><i class="bi bi-chevron-down"></i> Core Capabilities</a>
        </div>
      </div>

      <div class="hero-img-container">
        <img src="assets/img/hosting.jpg" alt="Database Architecture" onerror="this.src='assets/img/hero_img.webp'">
      </div>

    </div>
  </div>
</section>

<!-- ======= Database Capabilities ======= -->
<section class="creed-section" id="capabilities">
  <div class="creed-container">
    
    <div class="text-center" style="text-align: center;">
      <span class="section-tag"><i class="bi bi-hdd-stack-fill"></i> High Availability & Performance</span>
      <h2 class="section-title">Enterprise <span>Database</span> Engineering</h2>
      <p class="section-subtitle">
        Eliminate query bottlenecks, prevent locking regressions, and safeguard your core business data.
      </p>
    </div>

    <div class="bento-grid">
      
      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-speedometer"></i></div>
          <h3>Query Tuning & Index Optimization</h3>
          <p>Analyzing slow execution plans, implementing composite indexes, and eliminating costly table scans to accelerate response times.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-diagram-2"></i></div>
          <h3>Normalized & Denormalized Schema Design</h3>
          <p>Tailoring schema architectures for transactional integrity (OLTP) and fast analytical reporting (OLAP) with clean relational constraints.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-arrow-left-right"></i></div>
          <h3>Zero-Downtime Migration & ETL</h3>
          <p>Migrating multi-gigabyte production databases across platforms, cloud providers, and schema versions without taking live applications offline.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-shield-lock-fill"></i></div>
          <h3>Backup, Encryption & Disaster Recovery</h3>
          <p>Automated point-in-time recovery (PITR), AES-256 at-rest and in-transit encryption, and multi-region backup replication.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-layers-fill"></i></div>
          <h3>Caching & In-Memory Data Stores</h3>
          <p>Implementing Redis and Memcached layers to serve high-frequency read queries with sub-millisecond latency.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-server"></i></div>
          <h3>Replication & Failover Clustering</h3>
          <p>Configuring primary-replica configurations, automatic failover routing, and read-replica distribution for mission-critical uptime.</p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ======= CTA Section ======= -->
<section class="creed-section" style="background-color: var(--color-slate-50);">
  <div class="creed-container text-center" style="text-align: center;">
    <h2 class="section-title">Need Expert <span>Database</span> Optimization?</h2>
    <p class="section-subtitle">Let our database engineers evaluate your schema, indexes, and queries for peak performance.</p>
    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
      <a href="contact" class="btn-creed btn-creed-accent"><i class="bi bi-chat-text-fill"></i> Schedule DB Audit</a>
      <a href="services" class="btn-creed btn-creed-outline"><i class="bi bi-grid"></i> All Services</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>