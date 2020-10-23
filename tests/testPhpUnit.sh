# Ref: https://phpunit.readthedocs.io/en/9.3/textui.html

echo "Script executed from: ${PWD}"

SCRIPT_DIR=$(dirname $0)
echo "Script location: ${SCRIPT_DIR}"

# Perform test and outout result to file `test-result.html`
# Note: Use $SCRIPT_DIR to allow executing script from any location
"$SCRIPT_DIR/../vendor/bin/phpunit" -v --testdox-html "$SCRIPT_DIR/test-result.html" "$SCRIPT_DIR/models/ValidateRequesterTest.php"