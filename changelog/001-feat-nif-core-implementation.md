# 001 — feat(WidgetNif): core implementation

**Branch**: `001-feat-nif-core-implementation`
**PR**: #1

## Summary

- **WHY**: FacturaScripts `nif` field accepts any string — no algorithm validation (mod-23 NIF, NIE prefix substitution, CIF control char), no normalization (case/spaces/dashes), no user feedback.
- **WHAT**: `WidgetNif` (BaseWidget subclass) + `NifValidator` (full algorithmic: NIF mod-23, NIE X/Y/Z, CIF A-W entity types, passport fallback) + `nif-widget.js` (blur ✓/✗) + `nif-widget.css`.
- **IMPACT**: Any plugin XMLView using `<widget type="nif" fieldname="nif" />` gets trimmed/uppercased storage + client ✓/✗ feedback + server validator for model `test()`.

## Files

| File | Description |
|---|---|
| `Lib/Widget/WidgetNif.php` | BaseWidget subclass — type="nif", normalize + uppercase processFormData |
| `Lib/NifValidator.php` | validate() / detectType() / normalize() — NIF mod-23, NIE, CIF control char (letter/digit entity-dependent), passport |
| `Assets/JS/nif-widget.js` | Vanilla JS blur feedback (✓/✗), calls normalize heuristic client-side |
| `Assets/CSS/nif-widget.css` | `.nif-feedback-badge` sizing (Bootstrap input-group-text companion) |
| `Init.php` | Minimal lifecycle |
| `facturascripts.ini` | version=260629.1 |
| `composer.json` | No external dependencies |

## Test plan

- [ ] Install → `<widget type="nif" fieldname="nif" />` in any XMLView
- [ ] Input `12345678z` → saved as `12345678Z` (uppercase + no spaces)
- [ ] Input `12 345 678-Z` → saved as `12345678Z`
- [ ] Valid NIF blur → ✓ green; invalid `00000000T` → ✗ red
- [ ] NIE `X1234567L` → accepted; CIF `B12345674` → accepted
- [ ] Empty → null

## Cross-plugin impact

N/A — standalone utility plugin.
