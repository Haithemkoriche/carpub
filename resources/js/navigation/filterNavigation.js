export function filterNavByRole(navItems, role) {
  return navItems
    .filter(item => {
      // Check if this nav item is allowed for the role
      if (item.role && !item.role.includes(role)) return false

      // If it has children, filter them too
      if (item.children) {
        item.children = item.children.filter(child =>
          !child.role || child.role.includes(role)
        )

        // Only return the item if at least one child is valid
        return item.children.length > 0
      }

      return true
    })
}
