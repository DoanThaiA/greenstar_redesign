from pathlib import Path
from playwright.sync_api import sync_playwright


# ==========================================
# CONFIG
# ==========================================

URL = "https://greenstarvietnam.com/gioi-thieu/"

BASE_DIR = Path(__file__).resolve().parent.parent

REFERENCE_DIR = BASE_DIR / "reference"
REFERENCE_DIR.mkdir(parents=True, exist_ok=True)


# ==========================================
# CAPTURE
# ==========================================

with sync_playwright() as p:

    browser = p.chromium.launch(headless=True)

    # ======================================
    # DESKTOP
    # ======================================

    desktop = browser.new_page(
        viewport={
            "width": 1440,
            "height": 900,
        }
    )

    print(f"Opening: {URL}")

    desktop.goto(
        URL,
        wait_until="networkidle",
        timeout=60000,
    )

    # Chờ hình ảnh / animation load
    desktop.wait_for_timeout(5000)

    desktop.screenshot(
        path=str(
            REFERENCE_DIR / "greenstar-about-desktop.png"
        ),
        full_page=True,
    )

    print(
        "Saved:",
        REFERENCE_DIR / "greenstar-about-desktop.png",
    )

    desktop.close()


    # ======================================
    # MOBILE
    # ======================================

    mobile = browser.new_page(
        viewport={
            "width": 390,
            "height": 844,
        },
        is_mobile=True,
    )

    mobile.goto(
        URL,
        wait_until="networkidle",
        timeout=60000,
    )

    mobile.wait_for_timeout(5000)

    mobile.screenshot(
        path=str(
            REFERENCE_DIR / "greenstar-about-mobile.png"
        ),
        full_page=True,
    )

    print(
        "Saved:",
        REFERENCE_DIR / "greenstar-about-mobile.png",
    )

    mobile.close()

    browser.close()


print("\nAbout page screenshots captured successfully.")