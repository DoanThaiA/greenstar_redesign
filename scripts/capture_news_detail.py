from pathlib import Path
from playwright.sync_api import sync_playwright


# =====================================================
# CONFIG
# =====================================================

# Thay bằng URL bài News Detail thực tế
URLS = {
    "eherbal": "https://eherbal.co/are-freeze-dried-strawberries-keto-friendly-a-comprehensive-guide/",
    "greenstar": "https://greenstarvietnam.com/top-5-essential-rice-vermicelli-ingredients/",
}


# =====================================================
# PATH
# =====================================================

BASE_DIR = Path(__file__).resolve().parent.parent
REFERENCE_DIR = BASE_DIR / "reference"

REFERENCE_DIR.mkdir(parents=True, exist_ok=True)


# =====================================================
# SCREENSHOT
# =====================================================

with sync_playwright() as p:

    browser = p.chromium.launch(headless=True)

    for name, url in URLS.items():

        print("\n========================================")
        print(f"Capturing: {name}")
        print(f"URL: {url}")
        print("========================================")

        # =================================================
        # DESKTOP
        # =================================================

        desktop = browser.new_page(
            viewport={
                "width": 1440,
                "height": 900,
            }
        )

        try:
            desktop.goto(
                url,
                wait_until="networkidle",
                timeout=60000,
            )

            # Chờ ảnh, font, animation...
            desktop.wait_for_timeout(5000)

            output = (
                REFERENCE_DIR
                / f"{name}-news-detail-desktop.png"
            )

            desktop.screenshot(
                path=str(output),
                full_page=True,
            )

            print(f"Desktop saved: {output}")

        except Exception as e:
            print(f"Desktop error: {e}")

        finally:
            desktop.close()


        # =================================================
        # MOBILE
        # =================================================

        mobile = browser.new_page(
            viewport={
                "width": 390,
                "height": 844,
            },
            is_mobile=True,
            device_scale_factor=1,
        )

        try:
            mobile.goto(
                url,
                wait_until="networkidle",
                timeout=60000,
            )

            mobile.wait_for_timeout(5000)

            output = (
                REFERENCE_DIR
                / f"{name}-news-detail-mobile.png"
            )

            mobile.screenshot(
                path=str(output),
                full_page=True,
            )

            print(f"Mobile saved: {output}")

        except Exception as e:
            print(f"Mobile error: {e}")

        finally:
            mobile.close()


    browser.close()


print("\nAll News Detail screenshots captured successfully.")