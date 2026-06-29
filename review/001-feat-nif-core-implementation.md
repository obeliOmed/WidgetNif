# Review — PR #1 feat(WidgetNif): core implementation

**Reviewer**: Javi
**Branch**: `001-feat-nif-core-implementation`
**Base**: `develop`

## Pre-merge checklist

- [ ] `facturascripts.ini` version = `260629.1`
- [ ] No FacturaScripts core files modified
- [ ] No external dependencies

## Smoke test

1. Copy to `Plugins/WidgetNif/` → enable plugin
2. Add `<widget type="nif" fieldname="nif" />` to any XMLView
3. Enter `12 345 678-z` → save → DB shows `12345678Z`
4. Enter `invalid` → blur → ✗ red badge
5. Enter `12345678Z` → blur → ✓ green badge
6. Enter `B12345674` → blur → ✓ green (CIF)
7. Clear → save → DB shows NULL

## Expected result

✓ Uppercase + stripped stored  
✓ NIF/NIE/CIF/passport all validate correctly  
✓ Blur ✓/✗ feedback  
✓ Empty → NULL

## PASS / FAIL

☐ PASS &nbsp;&nbsp; ☐ FAIL

**Notes**:
