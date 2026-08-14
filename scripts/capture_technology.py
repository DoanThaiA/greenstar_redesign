from pathlib import Path
from playwright.sync_api import sync_playwright


# ==========================================
# CONFIG
# ==========================================

URL = "https://greenstarvietnam.com/nha-may/"


# ==========================================
# PATH
# ==========================================

BASE_DIR = Path(__file__).resolve().parent.parent

REFERENCE_DIR = BASE_DIR / "reference"

REFERENCE_DIR.mkdir(
    parents=True,
    exist_ok=True
)


# ==========================================
# SCREENSHOT
# ==========================================

with sync_playwright() as p:

    browser = p.chromium.launch(
        headless=True
    )

    # ======================================
    # DESKTOP
    # ======================================

    desktop = browser.new_page(
        viewport={
            "width": 1440,
            "height": 900
        }
    )

    print(f"Opening: {URL}")

    desktop.goto(
        URL,
        wait_until="networkidle",
        timeout=60000
    )

    # Chờ image / animation / font
    desktop.wait_for_timeout(5000)

    desktop.screenshot(
        path=str(
            REFERENCE_DIR
            / "greenstar-old-technology-desktop.png"
        ),
        full_page=True
    )

    print(
        "Desktop saved:",
        REFERENCE_DIR
        / "greenstar-old-technology-desktop.png"
    )

    desktop.close()


    # ======================================
    # MOBILE
    # ======================================

    mobile = browser.new_page(
        viewport={
            "width": 390,
            "height": 844
        },
        is_mobile=True,
        device_scale_factor=1
    )

    mobile.goto(
        URL,
        wait_until="networkidle",
        timeout=60000
    )

    mobile.wait_for_timeout(5000)

    mobile.screenshot(
        path=str(
            REFERENCE_DIR
            / "greenstar-old-technology-mobile.png"
        ),
        full_page=True
    )

    print(
        "Mobile saved:",
        REFERENCE_DIR
        / "greenstar-old-technology-mobile.png"
    )

    mobile.close()

    browser.close()


print("\nOur Technology screenshots captured successfully.")