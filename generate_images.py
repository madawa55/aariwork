#!/usr/bin/env python3
"""
Generate Sample Placeholder Images for Yuhaa Aari Work
Creates beautiful placeholder images for the portfolio
"""

import os
from pathlib import Path

try:
    from PIL import Image, ImageDraw, ImageFont
    PIL_AVAILABLE = True
except ImportError:
    PIL_AVAILABLE = False
    print("PIL/Pillow not installed. Installing now...")
    import subprocess
    subprocess.check_call(['pip', 'install', 'pillow'])
    from PIL import Image, ImageDraw, ImageFont
    PIL_AVAILABLE = True

# Configuration
UPLOAD_DIR = Path(__file__).parent / 'public' / 'uploads' / 'works'
WIDTH = 800
HEIGHT = 800

# Sample images configuration
IMAGES = [
    # Work 1 - Bridal Lehenga (Golden theme)
    {'name': 'sample-1-1.jpg', 'color': (212, 175, 55), 'text': 'Bridal Lehenga', 'subtitle': 'Golden Threads'},
    {'name': 'sample-1-2.jpg', 'color': (218, 165, 32), 'text': 'Bridal Lehenga', 'subtitle': 'Detail View'},
    {'name': 'sample-1-3.jpg', 'color': (184, 134, 11), 'text': 'Bridal Lehenga', 'subtitle': 'Close-up'},

    # Work 2 - Floral Saree (Soft colors)
    {'name': 'sample-2-1.jpg', 'color': (255, 182, 193), 'text': 'Floral Saree', 'subtitle': 'Border Work'},
    {'name': 'sample-2-2.jpg', 'color': (255, 160, 180), 'text': 'Floral Saree', 'subtitle': 'Detail'},

    # Work 3 - Royal Blue Anarkali
    {'name': 'sample-3-1.jpg', 'color': (65, 105, 225), 'text': 'Royal Anarkali', 'subtitle': 'Front View'},
    {'name': 'sample-3-2.jpg', 'color': (70, 130, 180), 'text': 'Royal Anarkali', 'subtitle': 'Neck Design'},
    {'name': 'sample-3-3.jpg', 'color': (72, 118, 255), 'text': 'Royal Anarkali', 'subtitle': 'Border Work'},
    {'name': 'sample-3-4.jpg', 'color': (100, 149, 237), 'text': 'Royal Anarkali', 'subtitle': 'Back View'},

    # Work 4 - Peacock Blouse (Green/Blue)
    {'name': 'sample-4-1.jpg', 'color': (0, 128, 128), 'text': 'Peacock Motif', 'subtitle': 'Blouse Design'},
    {'name': 'sample-4-2.jpg', 'color': (32, 178, 170), 'text': 'Peacock Motif', 'subtitle': 'Detail View'},

    # Work 5 - White Kurta (Light colors)
    {'name': 'sample-5-1.jpg', 'color': (240, 240, 245), 'text': 'White Kurta', 'subtitle': 'Minimalist'},
    {'name': 'sample-5-2.jpg', 'color': (245, 245, 250), 'text': 'White Kurta', 'subtitle': 'Embroidery'},
    {'name': 'sample-5-3.jpg', 'color': (235, 235, 240), 'text': 'White Kurta', 'subtitle': 'Detail'},

    # Work 6 - Red Dupatta
    {'name': 'sample-6-1.jpg', 'color': (178, 34, 34), 'text': 'Red Dupatta', 'subtitle': 'Bridal Collection'},
    {'name': 'sample-6-2.jpg', 'color': (220, 20, 60), 'text': 'Red Dupatta', 'subtitle': 'Zari Work'},
    {'name': 'sample-6-3.jpg', 'color': (165, 42, 42), 'text': 'Red Dupatta', 'subtitle': 'Border Detail'},

    # Work 7 - Pink Gown
    {'name': 'sample-7-1.jpg', 'color': (255, 192, 203), 'text': 'Pastel Gown', 'subtitle': 'Party Wear'},
    {'name': 'sample-7-2.jpg', 'color': (255, 182, 193), 'text': 'Pastel Gown', 'subtitle': 'Detail View'},

    # Work 8 - Emerald Jacket
    {'name': 'sample-8-1.jpg', 'color': (0, 128, 0), 'text': 'Emerald Jacket', 'subtitle': 'Ethnic Wear'},
    {'name': 'sample-8-2.jpg', 'color': (50, 205, 50), 'text': 'Emerald Jacket', 'subtitle': 'Front View'},
    {'name': 'sample-8-3.jpg', 'color': (46, 139, 87), 'text': 'Emerald Jacket', 'subtitle': 'Detail'},
]

def create_decorative_pattern(draw, width, height, color):
    """Create a decorative diagonal pattern"""
    # Diagonal lines
    for i in range(0, width + height, 40):
        line_color = tuple(min(255, c + 30) for c in color)
        draw.line([(i, 0), (i - height, height)], fill=line_color, width=2)

    # Add some dots for texture
    for x in range(50, width, 80):
        for y in range(50, height, 80):
            dot_color = tuple(min(255, c + 40) for c in color)
            draw.ellipse([x-3, y-3, x+3, y+3], fill=dot_color)

def calculate_brightness(color):
    """Calculate brightness of a color (0-255)"""
    return (color[0] * 299 + color[1] * 587 + color[2] * 114) / 1000

def create_image(config):
    """Create a single placeholder image"""
    # Create image with background color
    img = Image.new('RGB', (WIDTH, HEIGHT), config['color'])
    draw = ImageDraw.Draw(img)

    # Add decorative pattern
    create_decorative_pattern(draw, WIDTH, HEIGHT, config['color'])

    # Add border
    border_color = (255, 255, 255) if calculate_brightness(config['color']) < 128 else (200, 200, 200)
    draw.rectangle([10, 10, WIDTH-10, HEIGHT-10], outline=border_color, width=3)
    draw.rectangle([15, 15, WIDTH-15, HEIGHT-15], outline=border_color, width=1)

    # Determine text color based on background brightness
    text_color = (255, 255, 255) if calculate_brightness(config['color']) < 128 else (40, 40, 40)

    # Try to use a nice font, fall back to default if not available
    try:
        title_font = ImageFont.truetype("arial.ttf", 60)
        subtitle_font = ImageFont.truetype("arial.ttf", 40)
        watermark_font = ImageFont.truetype("arial.ttf", 24)
    except:
        title_font = ImageFont.load_default()
        subtitle_font = ImageFont.load_default()
        watermark_font = ImageFont.load_default()

    # Add main text (centered)
    title_text = config['text']
    subtitle_text = config['subtitle']

    # Get text bounding boxes for centering
    title_bbox = draw.textbbox((0, 0), title_text, font=title_font)
    title_width = title_bbox[2] - title_bbox[0]
    title_height = title_bbox[3] - title_bbox[1]

    subtitle_bbox = draw.textbbox((0, 0), subtitle_text, font=subtitle_font)
    subtitle_width = subtitle_bbox[2] - subtitle_bbox[0]
    subtitle_height = subtitle_bbox[3] - subtitle_bbox[1]

    # Calculate positions
    title_x = (WIDTH - title_width) // 2
    title_y = (HEIGHT - title_height - subtitle_height - 20) // 2
    subtitle_x = (WIDTH - subtitle_width) // 2
    subtitle_y = title_y + title_height + 20

    # Draw shadow for text (for better readability)
    shadow_color = (0, 0, 0) if text_color == (255, 255, 255) else (200, 200, 200)
    draw.text((title_x + 3, title_y + 3), title_text, font=title_font, fill=shadow_color)
    draw.text((subtitle_x + 2, subtitle_y + 2), subtitle_text, font=subtitle_font, fill=shadow_color)

    # Draw main text
    draw.text((title_x, title_y), title_text, font=title_font, fill=text_color)
    draw.text((subtitle_x, subtitle_y), subtitle_text, font=subtitle_font, fill=text_color)

    # Add watermark
    watermark = "YUHAA AARI WORK"
    watermark_bbox = draw.textbbox((0, 0), watermark, font=watermark_font)
    watermark_width = watermark_bbox[2] - watermark_bbox[0]
    watermark_x = (WIDTH - watermark_width) // 2
    watermark_y = HEIGHT - 60

    # Semi-transparent watermark
    watermark_color = tuple(int(c * 0.6) for c in text_color)
    draw.text((watermark_x, watermark_y), watermark, font=watermark_font, fill=watermark_color)

    # Add decorative corner elements
    corner_size = 50
    corner_color = tuple(min(255, c + 50) for c in config['color'])

    # Top-left corner
    draw.line([(30, 30), (30 + corner_size, 30)], fill=corner_color, width=2)
    draw.line([(30, 30), (30, 30 + corner_size)], fill=corner_color, width=2)

    # Top-right corner
    draw.line([(WIDTH - 30, 30), (WIDTH - 30 - corner_size, 30)], fill=corner_color, width=2)
    draw.line([(WIDTH - 30, 30), (WIDTH - 30, 30 + corner_size)], fill=corner_color, width=2)

    # Bottom-left corner
    draw.line([(30, HEIGHT - 30), (30 + corner_size, HEIGHT - 30)], fill=corner_color, width=2)
    draw.line([(30, HEIGHT - 30), (30, HEIGHT - 30 - corner_size)], fill=corner_color, width=2)

    # Bottom-right corner
    draw.line([(WIDTH - 30, HEIGHT - 30), (WIDTH - 30 - corner_size, HEIGHT - 30)], fill=corner_color, width=2)
    draw.line([(WIDTH - 30, HEIGHT - 30), (WIDTH - 30, HEIGHT - 30 - corner_size)], fill=corner_color, width=2)

    return img

def main():
    """Main function to generate all images"""
    print("=" * 60)
    print("  Yuhaa Aari Work - Sample Image Generator")
    print("=" * 60)
    print()

    # Create upload directory if it doesn't exist
    UPLOAD_DIR.mkdir(parents=True, exist_ok=True)
    print(f"Upload directory: {UPLOAD_DIR}")
    print()

    created = 0
    skipped = 0

    print("Generating placeholder images...\n")

    for img_config in IMAGES:
        filepath = UPLOAD_DIR / img_config['name']

        # Skip if file already exists
        if filepath.exists():
            print(f"[SKIP] {img_config['name']} (already exists)")
            skipped += 1
            continue

        # Create and save image
        try:
            img = create_image(img_config)
            img.save(filepath, 'JPEG', quality=90, optimize=True)
            created += 1
            print(f"[OK]   {img_config['name']}")
        except Exception as e:
            print(f"[ERR]  Error creating {img_config['name']}: {e}")

    print()
    print("=" * 60)
    print("  Summary")
    print("=" * 60)
    print(f"Images created: {created}")
    print(f"Images skipped: {skipped}")
    print(f"Location: {UPLOAD_DIR}")
    print()
    print("Sample images are ready!")
    print()
    print("Next steps:")
    print("1. Start your local web server")
    print("2. Visit http://localhost/ to see your portfolio")
    print("3. Check the gallery to see all sample works")
    print("4. Login to admin panel at http://localhost/admin/login")
    print()
    print("=" * 60)

if __name__ == "__main__":
    main()
