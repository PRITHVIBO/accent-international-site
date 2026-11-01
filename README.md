# Accent International — Dental Supply Website (v3)

This release updates the logo and colour palette using the supplied Accent International business-card/brochure image, expands the brand directory, adds brochure-listed contacts, and adds sample enquiry categories for manufacturers whose product families could be checked against published catalogues.

## Included

- `index.php` — responsive PHP site, enquiry catalogue, 16-brand directory, buyer journeys, contact details, map search and enquiry form.
- `assets/css/style.css` — responsive theme, motion, blue/cyan/green/burgundy branding and brand-card layouts.
- `assets/js/app.js` — navigation, scroll reveals, filters, persona-specific enquiry and AJAX submission.
- `assets/images/accent-emblem.png` — generated tooth/A/swoosh emblem based on the supplied Accent identity.
- `assets/images/accent-mark.svg` — simplified vector favicon mark.
- `api/quote.php` — PHP enquiry endpoint with validation, CSRF protection, honeypot and rate limiting.

## Run locally with XAMPP

1. Extract this folder into `C:\xampp\htdocs\`.
2. Start Apache in the XAMPP Control Panel.
3. Open `http://localhost/accent-international-site-v3/`.
4. Test the brand enquiry links, category filters, product enquiry buttons and form submission.

## Brand and authorisation notes

The supplied brochure states “Authorised Distributor of Mani Company” and places IMD / COXO under an “Exclusive Importer” banner. The website labels these as statements from the supplied brochure, not independently verified current appointments. Verify all current authorisation, exclusive-import, import/distribution and logo-use rights with the relevant companies before launch. The remaining names are presented as brand references transcribed from the brochure, not as authorised partnerships. `IMDSI` and `D-WHITE` are retained as printed and flagged for spelling/range confirmation.

Brand names are styled as text; official manufacturer logos have not been copied. The wordmark/emblem is an original refreshed design based on the visual direction of the supplied brochure.

## Contact details

Transcribed from the supplied brochure: Sandeep Gupta (+91 98290 66117), Krishna Gupta (+91 95293 09175), accentinternational21@yahoo.com and sandeep66117@yahoo.com. Address printed on brochure: B-9, Someshwar Mahadev Marg, Bhrampuri Khurra, Shivaji Chowk, Jaipur, Rajasthan 302002. Confirm current details and exact map pin with the business before going live.

The old public listing address was not carried over because it differed from the supplied brochure.

## Product examples and manufacturer references

Examples are enquiry references, not live-stock claims. Confirm exact model, variant, pack, local availability, batch/expiry and documentation before quotation.

- COXO: https://coxotec.com/
- KaVo: https://www.kavo.com/en/products
- VERICOM: https://www.vericom.co.kr/eng/main/main.html
- Kulzer: https://www.kulzer.com/en/en/for-dentists/startpage-dentists.html
- Zhermack: https://www.zhermack.com/en/
- 3M India Dental: https://www.3mindia.in/3M/en_IN/dental-in/products/
- DiaDent: https://www.diadent.kr/
- Woodpecker: https://www.glwoodpecker.com/
- MANI: https://mani-global.com/hcp/dental/
- HUGE Dental: https://www.hugedental.com/
- Dentsply Sirona: https://www.dentsplysirona.com/en-in.html

The product catalogue is an enquiry guide, not a live ecommerce store or a guarantee that all products are stocked, authorised, or immediately available. The website does not collect patient data or provide clinical recommendations.

## Production checklist

- Verify business contact details, address and map pin.
- Confirm the current MANI distributor and IMD/COXO exclusive-import wording.
- Obtain written permission before adding manufacturer logo artwork or partnership badges.
- Replace abstract product artwork with current licensed product pack shots.
- Confirm applicable Indian medical-device licensing, import, storage, traceability, labelling and documentation obligations for products actually supplied.
- Enable HTTPS, configure authenticated SMTP, and move enquiry storage outside the public web root or use a database/CRM.
- Add a privacy notice, data-retention policy and a monitored business mailbox before launch.

## Enquiry storage

Successful enquiries are appended to `storage/enquiries.jsonl`. Use the existing `.htaccess` protection on Apache. For production, keep enquiry data outside the public document root and back it up securely.
