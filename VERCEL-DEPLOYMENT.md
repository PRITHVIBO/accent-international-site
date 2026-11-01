# Deploy Accent International V3 on Vercel (PHP)

This project uses a root-level `index.php` and `api/quote.php`. Vercel must run it as a container; do not deploy it as a static site.

## Included Vercel files

- `Dockerfile.vercel` — runs PHP 8.4 with FrankenPHP.
- `Caddyfile` — serves the root-level PHP app and blocks access to storage/config files.
- `vercel.json` — selects Vercel's Container preset.

## GitHub deployment

1. Keep these three files in the repository root, at the same level as `index.php`.
2. Commit and push them to the branch connected to Vercel.
3. In Vercel → Project → Settings → Build and Deployment, ensure the Root Directory is the repository root (not `api` or `assets`).
4. If a Framework Preset override is shown, select `Container`. If the UI does not expose it, the root `vercel.json` selects it.
5. Clear any static Output Directory setting. Do not set the output directory to `public`, `dist`, or `.`.
6. Redeploy the latest commit from Deployments.

## Verify the deployment

- `/` should render the Accent International website, not download `index.php`.
- `/api/quote.php` opened with GET should return HTTP 405 and a JSON message telling the visitor to use the enquiry form. This is expected and confirms PHP executed.
- If the deployment returns 502, inspect Runtime Logs. Confirm the container starts and listens on port 80 (`PORT=80`).
- If the browser still downloads `index.php`, check the deployment's commit includes `Dockerfile.vercel`, `Caddyfile`, and `vercel.json` in the repository root, and check the deployment actually uses that commit.

## Important production note

The current demo writes enquiries to `storage/enquiries.jsonl`. Vercel container files are ephemeral and are not durable/shared across instances. Do not use this local JSONL file as the only customer-enquiry record for a live business. Move enquiries to persistent external storage/database and configure reliable email/CRM delivery before accepting real customer requests.

This container approach requires Docker image builds and is subject to Vercel's container/compute availability, limits, and pricing. It is not a promise of unlimited free PHP hosting.
