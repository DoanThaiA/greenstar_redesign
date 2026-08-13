from pathlib import Path
from playwright.sync_api import sync_playwright


# =========================
# CONFIG
# =========================

WEBSITES = {
    "eherbal": "https://eherbal.co/product-category/wholesale/freeze-dried-powders/",
    "greenstar": "https://greenstarvietnam.com/cua-hang/",
}

BASE_DIR = Path(__file__).resolve().parent.parent
REFERENCE_DIR = BASE_DIR / "reference"

REFERENCE_DIR.mkdir(parents=True, exist_ok=True)


# =========================
# SCREENSHOT
# =========================

with sync_playwright() as p:

    browser = p.chromium.launch(
        headless=True
    )

    for name, url in WEBSITES.items():

        print(f"\nOpening: {url}")

        # -------------------------
        # DESKTOP
        # -------------------------

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
                / f"{name}-products-desktop.png"
            )

            desktop.screenshot(
                path=str(output),
                full_page=True,
            )

            print(f"Desktop saved: {output}")

        except Exception as e:
            print(f"Desktop error ({name}): {e}")

        finally:
            desktop.close()


        # -------------------------
        # MOBILE
        # -------------------------

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
                / f"{name}-products-mobile.png"
            )

            mobile.screenshot(
                path=str(output),
                full_page=True,
            )

            print(f"Mobile saved: {output}")

        except Exception as e:
            print(f"Mobile error ({name}): {e}")

        finally:
            mobile.close()

    browser.close()


print("\nAll product screenshots captured.")