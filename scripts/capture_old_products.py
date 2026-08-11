from pathlib import Path
from playwright.sync_api import sync_playwright

URL = "https://greenstarvietnam.com/cua-hang/"

BASE_DIR = Path(__file__).resolve().parent.parent
REFERENCE_DIR = BASE_DIR / "reference"

with sync_playwright() as p:
    browser = p.chromium.launch()

    desktop = browser.new_page(
        viewport={"width": 1440, "height": 900}
    )

    desktop.goto(URL, wait_until="networkidle", timeout=60000)
    desktop.wait_for_timeout(5000)

    desktop.screenshot(
        path=str(
            REFERENCE_DIR / "greenstar-old-products-desktop.png"
        ),
        full_page=True
    )

    desktop.close()

    mobile = browser.new_page(
        viewport={"width": 390, "height": 844 },
        is_mobile=True
    )

    mobile.goto(URL, wait_until="networkidle", timeout=60000)
    mobile.wait_for_timeout(5000)

    mobile.screenshot(
        path=str(
            REFERENCE_DIR / "greenstar-old-products-mobile.png"
        ),
        full_page=True
    )

    mobile.close()

    browser.close()

print("Products screenshots captured.")