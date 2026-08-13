from pathlib import Path
from playwright.sync_api import sync_playwright


PRODUCTS = {
    "eherbal": "https://eherbal.co/eherbal-products/wholesale-freeze-dried-beetroot-powder/",
    "greenstar": "https://greenstarvietnam.com/bun-tuoi-say-kho/",
}

BASE_DIR = Path(__file__).resolve().parent.parent
REFERENCE_DIR = BASE_DIR / "reference"

REFERENCE_DIR.mkdir(parents=True, exist_ok=True)


with sync_playwright() as p:
    browser = p.chromium.launch(headless=True)

    for name, url in PRODUCTS.items():

        print(f"Opening: {url}")

        # Desktop
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

            desktop.wait_for_timeout(5000)

            output = (
                REFERENCE_DIR
                / f"{name}-product-detail-desktop.png"
            )

            desktop.screenshot(
                path=str(output),
                full_page=True,
            )

            print(f"Saved: {output}")

        except Exception as e:
            print(f"Desktop error: {e}")

        finally:
            desktop.close()


        # Mobile
        mobile = browser.new_page(
            viewport={
                "width": 390,
                "height": 844,
            },
            is_mobile=True,
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
                / f"{name}-product-detail-mobile.png"
            )

            mobile.screenshot(
                path=str(output),
                full_page=True,
            )

            print(f"Saved: {output}")

        except Exception as e:
            print(f"Mobile error: {e}")

        finally:
            mobile.close()

    browser.close()

print("Done.")