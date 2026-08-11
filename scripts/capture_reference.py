from pathlib import Path
from playwright.sync_api import sync_playwright


URL = "https://eherbal.co/"

BASE_DIR = Path(__file__).resolve().parent.parent
REFERENCE_DIR = BASE_DIR / "reference"


def capture_page(page, output_path: Path):
    page.goto(URL, wait_until="networkidle")

    # Chờ một chút để các hình ảnh/lazy-load hoàn thành
    page.wait_for_timeout(3000)

    page.screenshot(
        path=str(output_path),
        full_page=True
    )


with sync_playwright() as p:
    browser = p.chromium.launch()

    # =========================
    # Desktop
    # =========================

    desktop = browser.new_page(
        viewport={
            "width": 1440,
            "height": 900
        }
    )

    capture_page(
        desktop,
        REFERENCE_DIR / "eherbal-desktop.png"
    )

    desktop.close()

    # =========================
    # Mobile
    # =========================

    mobile = browser.new_page(
        viewport={
            "width": 390,
            "height": 844
        },
        is_mobile=True
    )

    capture_page(
        mobile,
        REFERENCE_DIR / "eherbal-mobile.png"
    )

    mobile.close()

    browser.close()

print("Screenshots captured successfully.")