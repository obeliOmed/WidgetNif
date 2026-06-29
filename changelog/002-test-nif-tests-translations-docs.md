# 002 — test(WidgetNif): tests, translations, and README

**Branch**: `002-test-nif-tests-translations-docs`
**PR**: #2
**Sequential to**: PR #1

## Summary

- **WHY**: PR #1 has no tests — NifValidator's mod-23 + CIF control-char logic is the most complex of all 3 widgets and needs explicit coverage.
- **WHAT**: PHPUnit suite (NifValidatorTest + WidgetNifTest) + 4 translations + README + LICENSE.
- **IMPACT**: Standalone `phpunit` validates the algorithm. Edge cases (NIE Y/Z, CIF always-letter entities, passport fallback) explicitly tested.

## Files

| File | Description |
|---|---|
| `Test/NifValidatorTest.php` | normalize, detectType (nif/nie/cif/passport/unknown), validate (mod-23, NIE prefix, CIF A-W entity types) |
| `Test/WidgetNifTest.php` | processFormData normalize+uppercase, null on empty |
| `Translation/{es_ES,en_EN,ca_ES,gl_ES}.json` | 4 locale files |
| `README.md` | Installation + XMLView usage + model::test() pattern |
| `LICENSE` | GPL-3.0-only |

## Test plan

```bash
composer install && ./vendor/bin/phpunit
```

- [ ] NIF valid: `12345678Z` ✓; invalid: `12345678A` ✗ (wrong letter)
- [ ] NIE: `X1234567L` ✓, `Y0000000T` ✓; invalid prefix → detectType=unknown
- [ ] CIF: `B12345674` ✓ (always-digit entity); `P1234567D` ✓ (always-letter entity)
- [ ] Passport: `ABC123456` → detectType=passport, validate returns true (structural only)
- [ ] normalize: strips spaces/dashes/dots + uppercase

## Cross-plugin impact

N/A
