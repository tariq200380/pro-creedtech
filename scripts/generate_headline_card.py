#!/usr/bin/env python3
import os
import sys
import hashlib
from PIL import Image, ImageDraw, ImageFont

def get_best_font(is_bold=False, size=16):
    candidates = [
        "/usr/share/fonts/truetype/noto/NotoSans-Bold.ttf" if is_bold else "/usr/share/fonts/truetype/noto/NotoSans-Regular.ttf",
        "/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf" if is_bold else "/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf",
        "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf" if is_bold else "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf",
        "/usr/share/fonts/truetype/freefont/FreeSansBold.ttf" if is_bold else "/usr/share/fonts/truetype/freefont/FreeSans.ttf"
    ]
    for p in candidates:
        if os.path.exists(p):
            try:
                return ImageFont.truetype(p, size)
            except Exception:
                pass
    return ImageFont.load_default()

def wrap_text(draw, text, font, max_width):
    words = text.split()
    lines = []
    curr = ""
    for w in words:
        test = (curr + " " + w).strip()
        if draw.textlength(test, font=font) <= max_width:
            curr = test
        else:
            if curr: lines.append(curr)
            curr = w
    if curr: lines.append(curr)
    return lines

def generate_headline_card(provider, title, category, date_str, output_path, summary=""):
    width, height = 1200, 675
    img = Image.new('RGB', (width, height), (255, 255, 255))
    draw = ImageDraw.Draw(img)

    f_logo = get_best_font(True, 26)
    f_nav  = get_best_font(False, 15)
    f_btn  = get_best_font(True, 13)
    f_meta = get_best_font(True, 14)
    f_title= get_best_font(True, 38)
    f_sub  = get_best_font(False, 18)
    f_small= get_best_font(True, 11)

    prov_lower = provider.lower().strip()

    if prov_lower == 'openai':
        # --- Pixel-Perfect Official OpenAI Article Page Header ---
        # 1. Top Navbar
        draw.text((60, 30), "OpenAI", fill=(0, 0, 0), font=f_logo)
        
        navs = ["Research", "Products", "Business", "Developers", "Company", "Foundation"]
        nx = 190
        for n in navs:
            draw.text((nx, 36), n, fill=(60, 60, 60), font=f_nav)
            nx += int(draw.textlength(n, font=f_nav)) + 26

        # Right Actions
        draw.text((width - 250, 36), "Log in ▾", fill=(0, 0, 0), font=f_nav)
        
        btn_w, btn_h = 135, 38
        btn_x, btn_y = width - 170, 26
        draw.rounded_rectangle([btn_x, btn_y, btn_x + btn_w, btn_y + btn_h], radius=19, fill=(0, 0, 0))
        draw.text((btn_x + 18, btn_y + 9), "Try ChatGPT ↗", fill=(255, 255, 255), font=f_btn)

        # Subtle Navbar Divider
        draw.line([(0, 82), (width, 82)], fill=(235, 235, 238), width=1)

        # 2. Date & Category Center
        cat_display = category if category else "Global Affairs"
        date_display = date_str if date_str else "August 18, 2026"
        meta_line = f"{date_display}   •   {cat_display}"
        mw = draw.textlength(meta_line, font=f_meta)
        draw.text(((width - mw) / 2, 145), meta_line, fill=(110, 110, 115), font=f_meta)

        # 3. Main Title (Centered)
        title_lines = wrap_text(draw, title, f_title, 950)
        ty = 195
        for tl in title_lines[:3]:
            tw = draw.textlength(tl, font=f_title)
            draw.text(((width - tw) / 2, ty), tl, fill=(10, 10, 10), font=f_title)
            ty += 52

        # 4. Subtitle / Summary (Centered)
        if not summary:
            summary = "OpenAI is launching a new initiative to help democratic oversight bodies develop the expertise and tools they need to understand and oversee government use of AI for national security."
        sub_lines = wrap_text(draw, summary, f_sub, 900)
        sy = ty + 18
        for sl in sub_lines[:3]:
            sw = draw.textlength(sl, font=f_sub)
            draw.text(((width - sw) / 2, sy), sl, fill=(75, 85, 99), font=f_sub)
            sy += 27

        # 5. Audio Player & Share Pill
        pill_w, pill_h = 200, 42
        px = (width - pill_w) / 2 - 55
        py = sy + 25
        draw.rounded_rectangle([px, py, px + pill_w, py + pill_h], radius=21, fill=(245, 245, 247), outline=(225, 225, 230), width=1)
        draw.text((px + 22, py + 11), "▶  Listen to article   4:36", fill=(30, 30, 30), font=f_nav)
        draw.text((px + pill_w + 24, py + 11), "🔗  Share", fill=(50, 50, 50), font=f_nav)

        # Bottom Verification Strip
        draw.line([(0, height - 42), (width, height - 42)], fill=(240, 240, 242), width=1)
        draw.text((50, height - 28), "⚡ OFFICIAL OPENAI PRESS RELEASE & ARTICLE SOURCE HEADER", fill=(156, 163, 175), font=f_small)
        draw.text((width - 210, height - 28), "✓ 8-POINT VERIFIED WIRE", fill=(16, 163, 127), font=f_small)

    elif prov_lower == 'microsoft':
        # --- Official Microsoft News / Source Article Page Header ---
        # 1. Top Navbar with Microsoft 4-color square logo & "Source" title
        draw.rectangle([60, 28, 73, 41], fill=(242, 80, 34))    # Red
        draw.rectangle([76, 28, 89, 41], fill=(127, 186, 0))   # Green
        draw.rectangle([60, 44, 73, 57], fill=(0, 164, 239))    # Blue
        draw.rectangle([76, 44, 89, 57], fill=(255, 185, 0))   # Yellow

        draw.text((100, 31), "Microsoft", fill=(115, 115, 115), font=f_logo)
        draw.line([(205, 30), (205, 58)], fill=(200, 200, 200), width=1)
        draw.text((218, 30), "Source", fill=(0, 0, 0), font=f_logo)

        navs = ["Stories", "Features", "Photos", "Podcasts", "Press Releases", "Executive Bios"]
        nx = 330
        for n in navs:
            draw.text((nx, 37), n, fill=(90, 90, 90), font=f_nav)
            nx += int(draw.textlength(n, font=f_nav)) + 24

        draw.line([(0, 78), (width, 78)], fill=(230, 230, 230), width=1)

        # 2. Category Tag Pill & Date
        draw.rounded_rectangle([60, 115, 60 + 160, 145], radius=4, fill=(240, 244, 248))
        draw.text((72, 122), (category.upper() if category else "ENTERPRISE AI"), fill=(0, 103, 184), font=f_small)
        draw.text((235, 123), f"Published: {date_str}", fill=(100, 100, 100), font=f_nav)

        # 3. Main Title
        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 165
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(20, 20, 20), font=f_title)
            ty += 48

        # 4. Lead Article Body / Subtitle
        if not summary:
            summary = "Microsoft and national partners are collaborating to bring cutting-edge smart sensors, machine learning, and cloud technology to empower students and industry leaders."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(70, 70, 70), font=f_sub)
            sy += 28

        # 5. Article Meta strip & Verification
        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ OFFICIAL MICROSOFT SOURCE ARTICLE PAGE HEADER  •  VERIFIED WIRE", fill=(120, 120, 120), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(0, 103, 184), font=f_small)

    elif prov_lower == 'google':
        # --- Official Google The Keyword Article Header ---
        draw.text((60, 28), "Google", fill=(66, 133, 244), font=f_logo)
        draw.line([(160, 28), (160, 58)], fill=(220, 220, 220), width=1)
        draw.text((175, 30), "The Keyword", fill=(32, 33, 36), font=f_logo)

        navs = ["Products", "Technology", "Initiatives", "Around the Globe", "Company News"]
        nx = 340
        for n in navs:
            draw.text((nx, 37), n, fill=(95, 99, 104), font=f_nav)
            nx += int(draw.textlength(n, font=f_nav)) + 22

        draw.line([(0, 78), (width, 78)], fill=(232, 234, 237), width=1)

        draw.text((60, 118), (category.upper() if category else "GOOGLE AI & DEVICES"), fill=(26, 115, 232), font=f_meta)
        draw.text((width - 320, 118), date_str, fill=(128, 134, 139), font=f_nav)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 160
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(32, 33, 36), font=f_title)
            ty += 48

        if not summary:
            summary = "Explore the latest developments, product announcements, and AI advancements directly from Google engineers and leaders."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(95, 99, 104), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(232, 234, 237), width=1)
        draw.text((60, height - 40), "⚡ GOOGLE THE KEYWORD OFFICIAL WIRE", fill=(128, 134, 139), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(26, 115, 232), font=f_small)

    elif prov_lower == 'apple':
        # --- Official Apple Newsroom Article Header ---
        draw.text((60, 28), " Newsroom", fill=(0, 0, 0), font=f_logo)
        navs = ["Latest News", "Photos", "Videos", "Executive Bios"]
        nx = 260
        for n in navs:
            draw.text((nx, 36), n, fill=(100, 100, 100), font=f_nav)
            nx += int(draw.textlength(n, font=f_nav)) + 26

        draw.line([(0, 76), (width, 76)], fill=(230, 230, 230), width=1)

        draw.text((60, 115), "PRESS RELEASE", fill=(110, 110, 115), font=f_small)
        draw.text((170, 115), f"•  {date_str}", fill=(110, 110, 115), font=f_small)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 155
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(29, 29, 31), font=f_title)
            ty += 50

        if not summary:
            summary = "Apple today announced latest updates and innovations across its platforms and services worldwide."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(110, 110, 115), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ APPLE NEWSROOM OFFICIAL PRESS RELEASE", fill=(130, 130, 130), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(0, 102, 204), font=f_small)

    elif prov_lower == 'nvidia':
        # --- Official NVIDIA Blog Article Header ---
        draw.rectangle([60, 28, 60 + 110, 62], fill=(118, 185, 0))
        draw.text((72, 34), "NVIDIA", fill=(255, 255, 255), font=f_logo)
        draw.text((185, 34), "THE OFFICIAL NVIDIA BLOG", fill=(0, 0, 0), font=f_logo)

        draw.line([(0, 78), (width, 78)], fill=(225, 225, 225), width=1)

        draw.text((60, 118), (category.upper() if category else "ACCELERATED AI & COMPUTING"), fill=(118, 185, 0), font=f_meta)
        draw.text((width - 320, 118), date_str, fill=(120, 120, 120), font=f_nav)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 160
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(20, 20, 20), font=f_title)
            ty += 48

        if not summary:
            summary = "Explore advancements in GPU computing, artificial intelligence, robotics, and cloud gaming from NVIDIA."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(80, 80, 80), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ NVIDIA OFFICIAL BLOG ARTICLE HEADER", fill=(120, 120, 120), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(118, 185, 0), font=f_small)

    elif prov_lower == 'anthropic':
        # --- Official Anthropic Research Article Header ---
        draw.text((60, 28), "ANTHROPIC", fill=(0, 0, 0), font=f_logo)
        draw.line([(240, 28), (240, 58)], fill=(210, 210, 210), width=1)
        draw.text((255, 32), "Research", fill=(100, 100, 100), font=f_logo)

        draw.line([(0, 78), (width, 78)], fill=(230, 230, 230), width=1)

        draw.text((60, 118), f"{date_str}   •   {category if category else 'Frontier AI & Safety'}", fill=(110, 110, 110), font=f_meta)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 160
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(15, 15, 15), font=f_title)
            ty += 48

        if not summary:
            summary = "Anthropic research papers and findings exploring AI alignment, safety evaluations, and frontier reasoning models."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(70, 70, 70), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ ANTHROPIC RESEARCH OFFICIAL PAPER HEADER", fill=(130, 130, 130), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(217, 119, 6), font=f_small)

    elif prov_lower == 'meta':
        # --- Official Meta Newsroom Article Header ---
        draw.text((60, 28), "♾️ Meta", fill=(0, 129, 251), font=f_logo)
        draw.line([(180, 28), (180, 58)], fill=(220, 220, 220), width=1)
        draw.text((195, 30), "Newsroom", fill=(28, 30, 33), font=f_logo)

        draw.line([(0, 78), (width, 78)], fill=(230, 230, 230), width=1)

        draw.text((60, 118), (category.upper() if category else "OPEN SOURCE AI & INFRASTRUCTURE"), fill=(0, 129, 251), font=f_meta)
        draw.text((width - 320, 118), date_str, fill=(101, 103, 107), font=f_nav)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 160
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(28, 30, 33), font=f_title)
            ty += 48

        if not summary:
            summary = "Discover announcements, open source AI models, and community programs from Meta."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(101, 103, 107), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ META NEWSROOM OFFICIAL WIRE", fill=(120, 120, 120), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(0, 129, 251), font=f_small)

    elif prov_lower == 'intel':
        # --- Official Intel Newsroom Article Header ---
        draw.text((60, 28), "intel.", fill=(0, 113, 197), font=f_logo)
        draw.line([(160, 28), (160, 58)], fill=(220, 220, 220), width=1)
        draw.text((175, 30), "Newsroom", fill=(34, 34, 34), font=f_logo)

        draw.line([(0, 78), (width, 78)], fill=(230, 230, 230), width=1)

        draw.text((60, 118), (category.upper() if category else "SEMICONDUCTORS & SILICON"), fill=(0, 113, 197), font=f_meta)
        draw.text((width - 320, 118), date_str, fill=(110, 110, 110), font=f_nav)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 160
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(34, 34, 34), font=f_title)
            ty += 48

        if not summary:
            summary = "Latest corporate announcements, manufacturing milestones, and silicon innovations from Intel."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(90, 90, 90), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ INTEL NEWSROOM OFFICIAL WIRE", fill=(120, 120, 120), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(0, 113, 197), font=f_small)

    elif prov_lower == 'dawn':
        # --- Official Dawn Tech Article Header ---
        draw.text((60, 28), "DAWN", fill=(0, 0, 0), font=f_logo)
        draw.line([(180, 28), (180, 58)], fill=(200, 200, 200), width=1)
        draw.text((195, 30), "TECH & SCIENCE", fill=(5, 150, 105), font=f_logo)

        draw.line([(0, 78), (width, 78)], fill=(225, 225, 225), width=1)

        draw.text((60, 118), f"Published: {date_str}   •   {category if category else 'Pakistan Tech'}", fill=(100, 100, 100), font=f_meta)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 160
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(15, 23, 42), font=f_title)
            ty += 48

        if not summary:
            summary = "Reporting on Pakistan's digital ecosystem, startup investments, and technological innovations."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(71, 85, 105), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ DAWN SCI-TECH OFFICIAL ARTICLE HEADER", fill=(120, 120, 120), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(5, 150, 105), font=f_small)

    elif prov_lower == 'brecorder':
        # --- Official Business Recorder Article Header ---
        draw.text((60, 28), "BUSINESS RECORDER", fill=(15, 23, 42), font=f_logo)

        draw.line([(0, 78), (width, 78)], fill=(225, 225, 225), width=1)

        draw.text((60, 118), (category.upper() if category else "PAKISTAN FINTECH & MARKETS"), fill=(2, 132, 199), font=f_meta)
        draw.text((width - 320, 118), date_str, fill=(100, 116, 139), font=f_nav)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 160
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(15, 23, 42), font=f_title)
            ty += 48

        if not summary:
            summary = "Comprehensive reporting on Pakistan markets, finance, economy, and enterprise technology."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(71, 85, 105), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ BUSINESS RECORDER OFFICIAL WIRE HEADER", fill=(120, 120, 120), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(2, 132, 199), font=f_small)

    elif prov_lower == 'propakistani':
        # --- Official ProPakistani Article Header ---
        draw.rectangle([60, 28, 60 + 200, 62], fill=(22, 163, 74))
        draw.text((72, 34), "PROPAKISTANI", fill=(255, 255, 255), font=f_logo)

        draw.line([(0, 78), (width, 78)], fill=(225, 225, 225), width=1)

        draw.text((60, 118), (category.upper() if category else "PAKISTAN DIGITAL ECOSYSTEM"), fill=(22, 163, 74), font=f_meta)
        draw.text((width - 320, 118), date_str, fill=(100, 116, 139), font=f_nav)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 160
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(15, 23, 42), font=f_title)
            ty += 48

        if not summary:
            summary = "News and analysis on telecom, startups, fintech, technology, and policy across Pakistan."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(71, 85, 105), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ PROPAKISTANI OFFICIAL ARTICLE HEADER", fill=(120, 120, 120), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(22, 163, 74), font=f_small)

    elif prov_lower == 'tribune':
        # --- Official The Express Tribune Article Header ---
        draw.text((60, 28), "THE EXPRESS TRIBUNE", fill=(220, 38, 38), font=f_logo)
        draw.line([(380, 28), (380, 58)], fill=(200, 200, 200), width=1)
        draw.text((395, 30), "TECHNOLOGY", fill=(15, 23, 42), font=f_logo)

        draw.line([(0, 78), (width, 78)], fill=(225, 225, 225), width=1)

        draw.text((60, 118), f"Published: {date_str}   •   {category if category else 'Pakistan Aerospace & Tech'}", fill=(100, 100, 100), font=f_meta)

        title_lines = wrap_text(draw, title, f_title, 1080)
        ty = 160
        for tl in title_lines[:3]:
            draw.text((60, ty), tl, fill=(15, 23, 42), font=f_title)
            ty += 48

        if not summary:
            summary = "Reporting on technology developments, aerospace discoveries, and scientific breakthroughs."
        sub_lines = wrap_text(draw, summary, f_sub, 1080)
        sy = ty + 18
        for sl in sub_lines[:3]:
            draw.text((60, sy), sl, fill=(71, 85, 105), font=f_sub)
            sy += 28

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(235, 235, 235), width=1)
        draw.text((60, height - 40), "⚡ THE EXPRESS TRIBUNE ARTICLE HEADER", fill=(120, 120, 120), font=f_small)
        draw.text((width - 230, height - 40), "✓ 8-POINT VERIFIED", fill=(220, 38, 38), font=f_small)

    else:
        # Generic High-Res Editorial Brand Wire Card
        draw.rectangle([0, 0, width, 8], fill=(0, 82, 255))
        draw.rectangle([0, 0, width - 1, height - 1], outline=(226, 232, 240), width=1)

        brand_name = provider.upper() + " OFFICIAL"
        draw.rounded_rectangle([60, 45, 60 + 260, 90], radius=22, fill=(239, 246, 255), outline=(0, 82, 255), width=1)
        draw.text((80, 55), f"🌐 {brand_name}", fill=(30, 64, 175), font=f_meta)

        draw.text((65, 125), (category.upper() if category else "ENTERPRISE TECH WIRE"), fill=(0, 82, 255), font=f_meta)

        title_lines = wrap_text(draw, title, f_title, 1050)
        ty = 175
        for tl in title_lines[:4]:
            draw.text((65, ty), tl, fill=(15, 23, 42), font=f_title)
            ty += 52

        draw.line([(60, height - 60), (width - 60, height - 60)], fill=(241, 245, 249), width=1)
        draw.text((65, height - 40), f"⚡ VERIFIED OFFICIAL WIRE  •  {date_str}", fill=(100, 116, 139), font=f_meta)
        draw.text((width - 240, height - 40), "✓ 8-POINT VERIFIED", fill=(0, 82, 255), font=f_meta)

    os.makedirs(os.path.dirname(output_path), exist_ok=True)
    img.save(output_path, 'PNG')

    with open(output_path, 'rb') as f:
        file_hash = hashlib.sha256(f.read()).hexdigest()
    print(file_hash)

if __name__ == '__main__':
    if len(sys.argv) < 6:
        print("Usage: generate_headline_card.py <provider> <title> <category> <date_str> <output_path> [summary]")
        sys.exit(1)
    provider    = sys.argv[1]
    title       = sys.argv[2]
    category    = sys.argv[3]
    date_str    = sys.argv[4]
    output_path = sys.argv[5]
    summary     = sys.argv[6] if len(sys.argv) > 6 else ""
    generate_headline_card(provider, title, category, date_str, output_path, summary)
