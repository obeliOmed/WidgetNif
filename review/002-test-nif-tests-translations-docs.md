# Review — PR #2 test(WidgetNif): tests, translations, and README

**Reviewer**: Javi
**Branch**: `002-test-nif-tests-translations-docs`
**Base**: `001-feat-nif-core-implementation`

## Pre-merge checklist

- [ ] PR #1 already merged
- [ ] 4 translations present
- [ ] README.md and LICENSE present

## Test run

```bash
cd Plugins/WidgetNif && composer install && ./vendor/bin/phpunit
```

Expected: all tests GREEN (no FS installation needed).

## Expected coverage

- [ ] NIF mod-23 valid + invalid letter → correct
- [ ] NIE X/Y/Z prefix substitution → correct
- [ ] CIF always-letter + always-digit entity types → correct
- [ ] normalize strips spaces/dashes/dots, uppercases
- [ ] processFormData → normalize on save, null on empty

## PASS / FAIL

☐ PASS &nbsp;&nbsp; ☐ FAIL

**Notes**:
