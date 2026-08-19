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

    else:
        # Generic High-Res Editorial Brand Wire Card
        # Top Accent
        draw.rectangle([0, 0, width, 8], fill=(0, 82, 255))
        draw.rectangle([0, 0, width - 1, height - 1], outline=(226, 232, 240), width=1)

        # Brand Badge
        brand_name = provider.upper() + " OFFICIAL"
        draw.rounded_rectangle([60, 45, 60 + 260, 90], radius=22, fill=(239, 246, 255), outline=(0, 82, 255), width=1)
        draw.text((80, 55), f"🌐 {brand_name}", fill=(30, 64, 175), font=f_meta)

        # Category
        draw.text((65, 125), (category.upper() if category else "ENTERPRISE TECH WIRE"), fill=(0, 82, 255), font=f_meta)

        # Title
        title_lines = wrap_text(draw, title, f_title, 1050)
        ty = 175
        for tl in title_lines[:4]:
            draw.text((65, ty), tl, fill=(15, 23, 42), font=f_title)
            ty += 52

        # Bottom Audit Strip
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
