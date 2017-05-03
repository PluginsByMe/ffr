# Enchants items.
# This code gives Full Iron Armor with Protection 1, Gold Sword with Sharp 4, 5 Gapples

$enchantmentdem1 = Enchantment::getEnchantment(0);
									$enchantmentdem1->setLevel(1);
									$enchantmentdem2 = Enchantment::getEnchantment(9);
									$enchantmentdem2->setLevel(4);
									$helmet = Item::get(306, 0, 1);
									$chestplate = Item::get(307, 0, 1);
									$leggings = Item::get(308, 0, 1);
									$boots = Item::get(309, 0, 1);
									$sword = Item::get(283, 0, 1);
									$inv = $sender->getInventory();
									$helmet->addEnchantment($enchantmentdem1);
									$chestplate->addEnchantment($enchantmentdem1);
									$leggings->addEnchantment($enchantmentdem1);
									$boots->addEnchantment($enchantmentdem1);
									$sword->addEnchantment($enchantmentdem2);
									$inv->addItem($sword);
									$sender->getInventory()->addItem(Item::get(322, 0, 5));
									$inv->setHelmet($helmet);
									$inv->setChestplate($chestplate);
									$inv->setLeggings($leggings);
									$inv->setBoots($boots);
